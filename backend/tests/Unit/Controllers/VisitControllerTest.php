<?php

use Api\Controllers\VisitController;
use Api\Exceptions\ResourceAlreadyExistsException;
use Api\Services\VisitService;
use Pecee\Http\Input\InputHandler;
use Pecee\Http\Request;
use Pecee\Http\Response;
use Pecee\SimpleRouter\SimpleRouter;

function injectResponseMock(): Response
{
    $ref = new ReflectionProperty(SimpleRouter::class, 'response');
    $ref->setAccessible(true);
    $ref->setValue(null, null);

    $mock = Mockery::mock(Response::class);
    $ref->setValue(null, $mock);

    return $mock;
}

function injectRequestMock(Request $request): void
{
    $router = SimpleRouter::router();

    $reqRef = new ReflectionProperty($router, 'request');
    $reqRef->setAccessible(true);
    $reqRef->setValue($router, $request);
}

function makeMockInputHandler(array $data): InputHandler
{
    $handler = Mockery::mock(InputHandler::class);
    $handler->shouldReceive('all')->andReturn($data);

    return $handler;
}

it('should create a visit and return 204', function () {
    $inputHandler = makeMockInputHandler([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '11987654321',
    ]);

    $request = Mockery::mock(Request::class);
    $request->shouldReceive('getInputHandler')->andReturn($inputHandler);

    injectRequestMock($request);

    $response = injectResponseMock();
    $response->shouldReceive('httpCode')->with(204)->andReturn($response);

    $service = Mockery::mock(VisitService::class);
    $service->shouldReceive('create')->andReturn(true);

    $controller = new VisitController($service);
    $controller->create(1);

    expect(true)->toBeTrue();
});

it('should return 422 on validation exception', function () {
    $inputHandler = makeMockInputHandler([
        'name' => 'ab',
        'email' => 'john@example.com',
        'phone' => '11987654321',
    ]);

    $request = Mockery::mock(Request::class);
    $request->shouldReceive('getInputHandler')->andReturn($inputHandler);

    injectRequestMock($request);

    $response = injectResponseMock();
    $response->shouldReceive('httpCode')->with(422)->andReturn($response);
    $response->shouldReceive('json')->andReturn();

    $service = Mockery::mock(VisitService::class);

    $controller = new VisitController($service);
    $controller->create(1);

    expect(true)->toBeTrue();
});

it('should return 409 on resource already exists exception', function () {
    $inputHandler = makeMockInputHandler([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '11987654321',
    ]);

    $request = Mockery::mock(Request::class);
    $request->shouldReceive('getInputHandler')->andReturn($inputHandler);

    injectRequestMock($request);

    $response = injectResponseMock();
    $response->shouldReceive('httpCode')->with(409)->andReturn($response);
    $response->shouldReceive('json')->andReturn();

    $service = Mockery::mock(VisitService::class);
    $service->shouldReceive('create')->andThrow(ResourceAlreadyExistsException::create());

    $controller = new VisitController($service);
    $controller->create(1);

    expect(true)->toBeTrue();
});
