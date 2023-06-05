<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception as ReaderException;
use PhpOffice\PhpSpreadsheet\Exception as SpreadsheetException;

class UsersImport extends Model
{
    use HasFactory;

    public static function import()
    {


        try {
            $spreadsheet = IOFactory::load(public_path('files/students.xlsx'));

            $worksheet = $spreadsheet->getActiveSheet();
            $data = $worksheet->toArray();

            foreach ($data as $row) {
                User::create([
                    'name' => $row[0],
                    'email' => $row[1],
                    'password' => bcrypt($row[2]),
                    'phone' => $row[3],
                    'type' => $row[4],
                ]);
            }

        } catch (ReaderException|SpreadsheetException $e) {
            var_dump($e->getMessage());
        }
    }
}
