<?php

declare(strict_types=1);

namespace Api\Controllers;

use Api\Data\DTOs\VisitRequestDto;
use Api\Exceptions\ResourceAlreadyExistsException;
use Api\Exceptions\ValidationException;
use Api\Repositories\VisitRepository;
use Api\Services\VisitService;

class VisitController
{
    private VisitService $visitService;

    public function __construct()
    {
        $this->visitService = new VisitService(new VisitRepository);
    }

    public function create(int $schedule_id)
    {
        try {
            $visitDto = VisitRequestDto::fromRequest($schedule_id, input()->all());
        } catch (ValidationException $e) {
            $errors = $e->getErrors();

            response()->httpCode(422)->json([
                'errors' => $errors,
            ]);
        }

        try {

            $this->visitService->create($visitDto);
        } catch (ResourceAlreadyExistsException $e) {
            $errors = ['visit' => $e->getMessage()];

            response()->httpCode(409)->json([
                'errors' => $errors,
            ]);
        }

        response()->httpCode(204);
    }
}
