<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use App\Models\User\RoleResourceModel;
use App\Models\User\UserRoleModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @throws ApiException
     */
    public function handle(Request $request, Closure $next)
    {
        $auth = auth()->user();
        if (!$auth) {
            throw new ApiException(HttpResponse::HTTP_UNAUTHORIZED);
        }

        if (!$auth['is_admin']) {
            // 用户选择的角色
            $roleId = $request->header('X-Request-Role', 0);
            // 用户请求的资源
            $resourceId = $request->header('X-Request-Resource', 0);
            // 期刊id
            $journalId = $request->header('X-Request-Journal', 0);
            $journals  = array_unique([0, $journalId]);

            // 查询用户是否有这个角色
            $userRole = UserRoleModel::query()
                ->where('user_id', $auth['id'])
                ->whereIn('journal_id', $journals)
                ->where('role_id', $roleId)
                ->first();
            if (!$userRole) {
                throw new ApiException(HttpResponse::HTTP_UNAUTHORIZED);
            }

            // 查询这个角色是否有资源的权限
            $roleResource = RoleResourceModel::query()
                ->where('role_id', $roleId)
                ->where('resource_id', $resourceId)
                ->first();
            if (!$roleResource) {
                throw new ApiException(HttpResponse::HTTP_UNAUTHORIZED);
            }
        }

        return $next($request);
    }
}
