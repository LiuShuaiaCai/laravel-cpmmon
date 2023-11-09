<?php


namespace App\Http\Expands;

use App\Exceptions\ApiException;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WordToPdf
{
    public static function convert(string $wordPath)
    {
        // 检查Word文档是否存在
//        if (!Storage::exists($wordPath)) {
//            dd('文件不存在');
//        }
        if (!file_exists($wordPath)) {
            dd('文件不存在');
        }

        // 生成一个随机的PDF文件名
        $pdfFileName = Str::random(10) . '.pdf';


//        $phpWord = new PhpWord();
        // 设置PHPWord缓存路径
//        Settings::setTempDir(storage_path('phpword'));

        // 创建PHPWord对象并加载Word文档
//        $wordFilePath = Storage::path($wordPath);
        $phpWord = IOFactory::load($wordPath);


        // 使用PHPOffice/PhpWord将Word文档保存为PDF
//        $pdfFilePath = storage_path('app/public/' . $pdfFileName);
//        $phpWord->save($pdfFileName, 'PDF');

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
        $objWriter->save('D:\PhpstormProjects\api.oaemesas.com\app\Console\Commands\helloWorld.html');
        dd(['pdf_url' => asset('storage/' . $pdfFileName)]);

        return response()->json(['pdf_url' => asset('storage/' . $pdfFileName)]);
    }
}