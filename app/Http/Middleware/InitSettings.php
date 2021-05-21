<?php
namespace App\Http\Middleware;
use Auth;
use Closure;
use App\Helpers\ListHelper;

class InitSettings
{
	public function handle($request, Closure $next)
	{
		if (!$request->is("install*")) {
			goto POFgg;
		}
		return $next($request);
		POFgg:$this->can_load();
		setSystemConfig();
		if (!Auth::guard("web")->check()) {
			goto fO1p0;
		}
		if (!$request->session()->has("impersonated")) {
			goto ez46W;
		}
		Auth::onceUsingId($request->session()->get("impersonated"));
		ez46W:
		if (!(!Auth::guard("web")->user()->isFromPlatform() && Auth::guard("web")->user()->merchantId())) {
			goto tDEdc;
		}
		setShopConfig(Auth::guard("web")->user()->merchantId());
		tDEdc:$permissions = ListHelper::authorizations();
		$permissions = isset($extra_permissions) ? array_merge($extra_permissions, $permissions) : $permissions;
		config()->set("permissions", $permissions);
		if (!Auth::guard("web")->user()->isSuperAdmin()) {
			goto ypL_d;
		}
		$slugs = ListHelper::slugsWithModulAccess();
		config()->set("authSlugs", $slugs);
		ypL_d:fO1p0:
		if ($request->ajax()) {
			goto d4g_u;
		}
		updateVisitorTable($request);
		d4g_u:return $next($request);
	}
	private function can_load()
	{
		if (!(ZCART_MIX_KEY != "017bf8bc885fb37b" || md5_file(base_path() . "/bootstrap/autoload.php") != "dd6510a4f78539f4ee97aa96a5276a60")) {
			goto P93mx;
		}
		die("Did you " . "remove the " . "old files " . "!?");
		P93mx:incevioAutoloadHelpers(getMysqliConnection());
	}
}
