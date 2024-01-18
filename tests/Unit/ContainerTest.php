<?php
test('it can resolve smth out of the container', function () {
    // arrange
    $container = new \app\Core\Container();
    $container->bind('foo', fn() => 'bar');

    // act
    $result = $container->resolve('foo');

    // assert/expected result
    expect($result)->toEqual('bar');
});
