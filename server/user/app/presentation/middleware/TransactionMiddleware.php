<?php

namespace app\presentation\middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class TransactionMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        DB::beginTransaction();

        try {
            $response = $next($request);

            if ($response->exception) {
                DB::rollBack();
            } else {
                DB::commit();
            }

        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return $response;
    }
}
