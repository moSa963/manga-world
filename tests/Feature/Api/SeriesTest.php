<?php

use App\Models\Chapter;

test('user can get a list of series', function () {
    $chapters = Chapter::factory(3)->create();

    $response = $this->get('api/series');

    foreach ($chapters as $s) {
        $s->series->delete();
    }

    $response->assertSuccessful();

    $response->assertJsonCount(3, 'data');
});
