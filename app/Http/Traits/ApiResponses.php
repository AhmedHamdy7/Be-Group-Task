<?php

namespace App\Http\Traits;
trait ApiResponses
{
    // Success response
    public function ok($data, $message = null)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], 200);
    }

    // Success response with pagination detailsa
    protected function okWithPagination($data, mixed $pagination): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => 'resource fetched successfully',
            'data' => $data,
            'links' => [
                'first' => $pagination->onFirstPage() ? null : $pagination->url(1),
                'last' => $pagination->hasMorePages() ? $pagination->url($pagination->lastPage()) : null,
                'prev' => $pagination->previousPageUrl(),
                'next' => $pagination->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $pagination->currentPage(),
                'from' => $pagination->firstItem(),
                'last_page' => $pagination->lastPage(),
                'path' => $pagination->path(),
                'per_page' => $pagination->perPage(),
                'to' => $pagination->lastItem(),
                'total' => $pagination->total(),
            ],
        ]);
    }

    // Created response
    public function created($data, $message = null)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], 201);
    }

    // Updated response
    public function updated($data, $message = null)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], 200);
    }

    // Deleted response
    public function deleted($message = null)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message
        ], 200);
    }

    // No content response
    public function noContent($message = null)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message
        ], 204);
    }

    // Bad request response
    public function badRequest($message = null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], 400);
    }

    // Unauthorized response
    public function unauthorized($message = null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], 401);
    }

    // Forbidden response
    public function forbidden($message = null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], 403);
    }

    // Not found response
    public function notFound($message = null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], 404);
    }

    // Method not allowed response
    public function methodNotAllowed($message = null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], 405);
    }

    // Conflict response
    public function conflict($message = null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], 409);
    }

    // Error response
    public function error($message = null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], 500);
    }

    // Pending account response
    public function pendingAccount($message = null)
    {
        return response()->json([
            'status' => 'action_required',
            'message' => $message
        ], 200);
    }
}
