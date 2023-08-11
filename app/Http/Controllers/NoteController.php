<?php

namespace App\Http\Controllers;

use App\Dtos\WrapPagination;
use App\Http\Requests\Note\NoteIndexRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;
use OpenApi\Attributes as OAT;

class NoteController extends Controller
{
    /**
     * Get a list of notes of User (Pagination applied)
     *
     * @param  NoteIndexRequest  $request
     * @return JsonResponse
     */
    #[OAT\Get(
        tags: ['note'],
        path: '/api/note',
        summary: 'Get a list of notes of User (Pagination applied)',
        operationId: 'NoteController.index',
        security: [['BearerToken' => []]],
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
                                    items: new OAT\Items(ref: '#/components/schemas/NoteResource')
                                ),
                            ]
                        ),
                    ]
                ),
            ),
        ]
    )]
    public function index(NoteIndexRequest $request): JsonResponse
    {
        $limit = $request->input('limit', config('pagination.limit', 10));
        $notes = Note::where('user_id', $request->user()->id)->paginate($limit);

        return Response::json(new WrapPagination(NoteResource::collection($notes)->resource));
    }
}
