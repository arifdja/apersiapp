<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class FileController extends Controller
{
    public function downloadkta($berkaskta)
    {
        $model = new UserModel();

        // Fetch file info from the database
        $file = $model->where('berkaskta',$berkaskta)->first();

        if (!$file) {
            return redirect()->back()->with('error', 'File not found.');
        }

        // File path in the upload folder
        $filePath = WRITEPATH . 'uploads/' . $file['berkaskta'];

        // Check if the file exists
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File not found on the server.');
        }

        // Force download the file
        return $this->response->download($filePath, null)->setFileName($file['berkaskta']);
    }
}
