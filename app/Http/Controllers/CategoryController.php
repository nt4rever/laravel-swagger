<?php

namespace App\Http\Controllers;

use App\Dtos\WrapPagination;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryDeleteRequest;
use App\Http\Requests\Category\CategoryIndexRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use OpenApi\Attributes as OAT;
use Response;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  CategoryService  $categoryService
     * @return void
     */
    public function __construct(private CategoryService $categoryService)
    {
        //
    }

    /**
     * Get a list of note category (Pagination applied).
     *
     * @param  CategoryIndexRequest  $request
     * @return JsonResponse
     */
    #[OAT\Get(
        tags: ['category'],
        path: '/api/category',
        summary: 'Get a list of category of User (Pagination applied).',
        operationId: 'CategoryController.index',
        security: [['BearerToken' => []]],
        parameters: [
            new OAT\Parameter(
                in: 'query',
                parameter: 'limit',
                name: 'limit',
                schema: new OAT\Schema(
                    type: 'integer',
                    default: 10,
                )
            ),
            new OAT\Parameter(
                in: 'query',
                parameter: 'page',
                name: 'page',
                schema: new OAT\Schema(
                    type: 'integer',
                    default: 1,
                )
            ),
        ],
        responses: [
            new OAT\Response(
                response: HttpResponse::HTTP_OK,
                description: 'Ok',
                content: new OAT\JsonContent(
                    allOf: [
                        new OAT\Schema(
                            ref: '#/components/schemas/WrapPagination',
                        ),
                        new OAT\Schema(
                            type: 'object',
                            properties: [
                                new OAT\Property(
                                    property: 'data',
                                    type: 'array',
                                    items: new OAT\Items(ref: '#/components/schemas/CategoryResource')
                                ),
                            ]
                        ),
                    ]
                ),
            ),
        ]
    )]
    public function index(CategoryIndexRequest $request): JsonResponse
    {
        $limit = $request->input('limit', config('pagination.limit', 10));
        $data = $this->categoryService->categories($limit);

        return Response::json(new WrapPagination(CategoryResource::collection($data)->resource));
    }

    /**
     * Create a new note category.
     *
     * @param  CategoryCreateRequest  $request
     * @return JsonResponse
     */
    #[OAT\Post(
        tags: ['category'],
        path: '/api/category',
        summary: 'Create a new note category.',
        operationId: 'CategoryController.store',
        security: [['BearerToken' => []]],
        requestBody: new OAT\RequestBody(
            required: true,
            content: new OAT\JsonContent(ref: '#/components/schemas/CategoryCreateRequest')
        ),
        responses: [
            new OAT\Response(
                response: HttpResponse::HTTP_CREATED,
                description: 'Ok',
                content: new OAT\JsonContent(ref: '#/components/schemas/CategoryResource')
            ),
            new OAT\Response(
                response: HttpResponse::HTTP_UNPROCESSABLE_ENTITY,
                description: 'Unprocessable entity',
                content: new OAT\JsonContent(ref: '#/components/schemas/ValidationError')
            ),
        ],
    )]
    public function store(CategoryCreateRequest $request): JsonResponse
    {
        $category = $this->categoryService->storeCategory($request->validated());

        return Response::json(new CategoryResource($category), HttpResponse::HTTP_CREATED);
    }

    /**
     * Delete a note category.
     *
     * @param  CategoryDeleteRequest  $request
     * @param  Category  $category
     * @return JsonResponse
     */
    #[OAT\Delete(
        tags: ['category'],
        path: '/api/category/{id}',
        summary: 'Delete a note category.',
        operationId: 'CategoryController.destroy',
        security: [['BearerToken' => []]],
        parameters: [
            new OAT\Parameter(
                required: true,
                in: 'path',
                parameter: 'id',
                name: 'id',
                schema:
                new OAT\Schema(
                    type: 'integer',
                    default: 1,
                )
            ),
        ],
        responses: [
            new OAT\Response(
                response: HttpResponse::HTTP_NO_CONTENT,
                description: 'Delete the category successfully',
            ),
            new OAT\Response(
                response: HttpResponse::HTTP_NOT_FOUND,
                description: 'Not found the category',
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: 'message',
                            type: 'string',
                            example: 'No query results for model [App\\Models\\Category] 10'
                        ),
                    ]
                )
            ),
            new OAT\Response(
                response: HttpResponse::HTTP_FORBIDDEN,
                description: 'This action is unauthorized',
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: 'message',
                            type: 'string',
                            example: 'This action is unauthorized.'
                        ),
                    ]
                )
            ),
        ],
    )]
    public function destroy(CategoryDeleteRequest $request, Category $category)
    {
        $category->delete();

        return Response::json([], HttpResponse::HTTP_NO_CONTENT);
    }

    /**
     * Update a note category.
     *
     * @param  CategoryUpdateRequest  $request
     * @param  Category  $category
     * @return JsonResponse
     */
    #[OAT\Put(
        tags: ['category'],
        path: '/api/category/{id}',
        summary: 'Update a note category.',
        operationId: 'CategoryController.update',
        security: [['BearerToken' => []]],
        parameters: [
            new OAT\Parameter(
                required: true,
                in: 'path',
                parameter: 'id',
                name: 'id',
                schema:
                new OAT\Schema(
                    type: 'integer',
                    default: 1,
                )
            ),
        ],
        requestBody: new OAT\RequestBody(
            required:true,
            content: new OAT\JsonContent(ref: '#/components/schemas/CategoryUpdateRequest')
        ),
        responses: [
            new OAT\Response(
                response: HttpResponse::HTTP_OK,
                description: 'Ok',
                content: new OAT\JsonContent(ref: '#/components/schemas/CategoryResource')
            ),
            new OAT\Response(
                response: HttpResponse::HTTP_NOT_FOUND,
                description: 'Not found the category',
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: 'message',
                            type: 'string',
                            example: 'No query results for model [App\\Models\\Category] 10'
                        ),
                    ]
                )
            ),
            new OAT\Response(
                response: HttpResponse::HTTP_FORBIDDEN,
                description: 'This action is unauthorized',
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: 'message',
                            type: 'string',
                            example: 'This action is unauthorized.'
                        ),
                    ]
                )
            ),
        ]
    )]
    public function update(CategoryUpdateRequest $request, Category $category): JsonResponse
    {
        $this->categoryService->updateCategory($category, $request->validated());

        return Response::json(new CategoryResource($category));
    }
}
