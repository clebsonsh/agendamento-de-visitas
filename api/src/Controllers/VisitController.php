<?php

declare(strict_types=1);

namespace Api\Controllers;

use Api\Data\DTOs\ErrorResponseDto;
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

    public function create(int $scheduleId)
    {
        try {
            $this->visitService->create(VisitRequestDto::fromRequest($scheduleId, input()->all()));
        } catch (ValidationException $e) {
            response()->httpCode(422)->json(
                new ErrorResponseDto($e->getMessage(), $e->getErrors())
            );
        } catch (ResourceAlreadyExistsException $e) {
            response()->httpCode(409)->json(new ErrorResponseDto($e->getMessage()));
        }

        response()->httpCode(204);
    }
}
