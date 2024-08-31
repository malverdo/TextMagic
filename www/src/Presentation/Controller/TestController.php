<?php

declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Domain\Services\TestHandler;
use App\Domain\Services\TestResultHandler;
use App\Presentation\Dto\RequestResultTestDto;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    public function __construct(
        private readonly TestHandler $test,
        private readonly TestResultHandler $testResult,
    ) {
    }

    #[OA\Post(
        path: '/test',
        operationId: 'handleTest',
        description: 'Создает новый результат теста, принимая идентификатор теста, идентификатор результата теста и список ответов на вопросы. ',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                examples: [
                    new OA\Examples(
                        example: 'example 1',
                        summary: 'Пример 1',
                        value: '{
                            "testId": 1, 
                            "testResultId": 21,
                            "questions": [
                                {
                                    "id": 1,
                                    "answerIds": [
                                        2
                                    ]
                                },
                                {
                                    "id": 2,
                                    "answerIds": [
                                        4,
                                        5
                                    ]
                                },
                                {
                                    "id": 3,
                                    "answerIds": [
                                        8,
                                        9,
                                        10
                                    ]
                                }
                            ]
                        }'
                    ),
                ],
                ref: '#/components/schemas/RequestResultTestDto'
            )
        ),
        tags: ['Test'],
        responses: [
            new OA\Response(
                response: 201,
                description: 'Created',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'status', type: 'string', example: 'success'),
                        new OA\Property(property: 'response', type: 'array', items: new OA\Items(), example: []),
                    ],
                    type: 'object'
                )
            ),
        ]
    )]
    #[Route(path: '/test', name: 'app_test_handle', methods: 'POST')]
    public function handleTest(
        #[MapRequestPayload] RequestResultTestDto $resultDto,
    ): JsonResponse {
        $this->test->handler($resultDto);

        return new JsonResponse(
            ['status' => 'success', 'response' => []],
            Response::HTTP_CREATED,
            ['Content-Type' => 'application/json; charset=utf-8'],
            false
        );
    }

    #[OA\Get(
        path: '/test/result/{testResultId}',
        operationId: 'getTestResult',
        description: 'Возвращает результат теста',
        tags: ['Test'],
        parameters: [
            new OA\Parameter(
                name: 'testResultId',
                description: 'Идентификатор результата теста',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    example: 21 // Пример значения параметра
                )
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Успешное получение результата теста',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'status',
                            type: 'string',
                            example: 'success'
                        ),
                        new OA\Property(
                            property: 'response',
                            type: 'array',
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(
                                        property: 'success',
                                        type: 'array',
                                        items: new OA\Items(
                                            properties: [
                                                new OA\Property(
                                                    property: 'isCorrect',
                                                    type: 'boolean',
                                                    example: true
                                                ),
                                                new OA\Property(
                                                    property: 'titleQuestion',
                                                    type: 'string',
                                                    example: '1 + 1 = '
                                                ),
                                                new OA\Property(
                                                    property: 'questionId',
                                                    type: 'integer',
                                                    example: 1
                                                ),
                                            ],
                                            type: 'object'
                                        )
                                    ),
                                    new OA\Property(
                                        property: 'failed',
                                        type: 'array',
                                        items: new OA\Items(
                                            properties: [
                                                new OA\Property(
                                                    property: 'isCorrect',
                                                    type: 'boolean',
                                                    example: false
                                                ),
                                                new OA\Property(
                                                    property: 'titleQuestion',
                                                    type: 'string',
                                                    example: '3 + 3 = '
                                                ),
                                                new OA\Property(
                                                    property: 'questionId',
                                                    type: 'integer',
                                                    example: 3
                                                ),
                                            ],
                                            type: 'object'
                                        )
                                    ),
                                ],
                                type: 'object'
                            ),
                            example: [
                                [
                                    'success' => [
                                        [
                                            'isCorrect' => true,
                                            'titleQuestion' => '1 + 1 = ',
                                            'questionId' => 1,
                                        ],
                                        [
                                            'isCorrect' => true,
                                            'titleQuestion' => '2 + 2 = ',
                                            'questionId' => 2,
                                        ],
                                    ],
                                    'failed' => [
                                        [
                                            'isCorrect' => false,
                                            'titleQuestion' => '3 + 3 = ',
                                            'questionId' => 3,
                                        ],
                                    ],
                                ],
                            ]
                        ),
                    ],
                    type: 'object'
                )
            ),
        ]
    )]
    #[Route(path: '/test/result/{testResultId}', name: 'app_test_result', methods: 'GET')]
    public function getTestResult(
        int $testResultId,
    ): JsonResponse {
        $response = $this->testResult->handler($testResultId);

        return new JsonResponse(
            ['status' => 'success', 'response' => [$response]],
            Response::HTTP_OK,
            ['Content-Type' => 'application/json; charset=utf-8'],
            false
        );
    }
}
