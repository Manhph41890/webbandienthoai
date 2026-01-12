<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = ['current_password', 'password', 'password_confirmation'];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                // Nếu là API thì trả về JSON (tùy chọn)
                return response()->json(['message' => 'Not Found'], 404);
            }
            // Điều hướng về route có tên là '404'
            return redirect()->route('404');
        });

        // Xử lý lỗi 403
        $this->renderable(function (AccessDeniedHttpException $e, $request) {
            return redirect()->route('403');
        });
    }
}
