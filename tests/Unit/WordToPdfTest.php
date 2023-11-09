<?php

namespace Tests\Unit;

use App\Http\Expands\WordToPdf;
use PHPUnit\Framework\TestCase;

class WordToPdfTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);

        $path = '/c/Users/Admin/Downloads/Template_for_Correction_Erratum_Retraction_cdr.docx';
        WordToPdf::convert($path);
    }
}
