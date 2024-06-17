<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Src\Modules\Companies\Application\Creator;
use Src\Modules\Companies\Application\Updater;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller
{
    public function store(StoreCompanyRequest $request, Creator $useCase)
    {
        $useCase->__invoke(
            $request->validated('state'),
            $request->validated('name'),
            $request->validated('assignThemselves'),
        );

        return $this->success(data: $useCase, code: Response::HTTP_CREATED);
    }

    public function update(UpdateCompanyRequest $request, Company $company, Updater $useCase)
    {
        $useCase->__invoke($company, $request->validated('assignThemselves'));

        return $this->success(data: $useCase);
    }
}
