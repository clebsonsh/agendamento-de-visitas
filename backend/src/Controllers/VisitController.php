<?php

declare(strict_types=1);

namespace Api\Controllers;

use Api\Container;
use Api\Data\DTOs\ErrorResponseDto;
use Api\Data\DTOs\VisitRequestDto;
use Api\Exceptions\ResourceAlreadyExistsException;
use Api\Exceptions\ValidationException;
use Api\Services\VisitService;
use Pecee\Http\Input\InputHandler;

class VisitController
{
    private VisitService $visitService;

    public function __construct()
    {
        $container = Container::getInstance();
        $this->visitService = $container->get(VisitService::class);
    }

    public function create(int $scheduleId): void
    {
        /** @var InputHandler */
        $input = input();

        /** @var array<string, string> */
        $request = $input->all();

        try {
            $this->visitService->create(
                VisitRequestDto::fromRequest($scheduleId, $request)
            );
        } catch (ValidationException $e) {
            response()->httpCode(422)->json(
                new ErrorResponseDto($e->getMessage(), $e->getErrors())
            );

            return;
        } catch (ResourceAlreadyExistsException $e) {
            response()->httpCode(409)->json(
                new ErrorResponseDto($e->getMessage())
            );

            return;
        }

        response()->httpCode(204);
    }
}
