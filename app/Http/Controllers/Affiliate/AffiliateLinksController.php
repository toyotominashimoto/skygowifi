<?php

namespace App\Http\Controllers\Affiliate;
use App\Domains\Affiliate\Actions\AffiliateLinkAction;
use App\Domains\Affiliate\DTO\AffiliateDTO\UpdateAffiliateData;
use App\Domains\Affiliate\DTO\AffiliateDTO\CreateAffiliateData;
use Illuminate\Support\Facades\DB;
use App\Domains\Affiliate\Gateways\AffiliateLinkGateway;
use App\Domains\Affiliate\DTO\AffiliateLinkDTO\CreateAffiliateLinkData;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AffiliateLink\CreateAffiliateLinkRequest;

class AffiliateLinksController extends Controller
{
    /**
     * Get all affiliates
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        $gateway = new AffiliateLinkGateway();
        
        $filters = json_decode($request->get('filters'), true);
        if (!empty($filters)) {
            $gateway->setFilters($filters);
        }
        $keywords =$request->get('keywords');
        if ($keywords) {
            $gateway->setSearch($keywords, ['code']);
        }
        $affiliates = $gateway->all();
        return $affiliates;
    }

    public function generate(CreateAffiliateLinkRequest $request)
    {
        $data = CreateAffiliateLinkData::fromRequest(($request));

        $affiliate = (new AffiliateLinkAction)->create($data);

        return $affiliate;
    }
}
