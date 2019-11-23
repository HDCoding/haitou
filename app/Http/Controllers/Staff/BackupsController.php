<?php

namespace App\Http\Controllers\Staff;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Adapter\Local;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BackupsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!count(config('backup.backup.destination.disks'))) {
            dd('Nenhum disco de backup configurado em config/backup.php');
        }

        $data['backups'] = [];

        foreach (config('backup.backup.destination.disks') as $disk_name) {
            $disk = Storage::disk($disk_name);
            $adapter = $disk->getDriver()->getAdapter();
            $files = $disk->allFiles();

            // cria uma matriz de arquivos de backup, com tamanho de arquivo e data de criação
            foreach ($files as $key => $file) {
                // considera apenas os arquivos zip
                if (substr($file, -4) == '.zip' && $disk->exists($file)) {
                    $data['backups'][] = [
                        'file_path' => $file,
                        'file_name' => str_replace('backups/', '', $file),
                        'file_size' => $disk->size($file),
                        'last_modified' => $disk->lastModified($file),
                        'disk' => $disk_name,
                        'download' => ($adapter instanceof Local) ? true : false,
                    ];
                }
            }
        }

        // inverter os backups, então o mais novo estaria no topo
        $data['backups'] = array_reverse($data['backups']);

        return view('staff.backups.index', compact('data'));
    }

    /**
     * Create a Backup
     */
    public function create()
    {
        try {
            ini_set('max_execution_time', 900);
            // inicia o processo de backup
            Artisan::call('backup:run');
            $output = Artisan::output();

            // registra os resultados
            info('Um novo Backup-Completo foi iniciado no painel admin ' . $output);
            //return the results as a response to te ajax call
            echo $output;
        } catch (Exception $exception) {
            response($exception->getMessage(), 500);
        }
        return 'success';
    }

    /**
     * Create a backup
     */
    public function createFilesOnly()
    {
        try {
            ini_set('max_execution_time', 900);
            // inicia o processo de backup
            Artisan::call('backup:run --only-files');
            $output = Artisan::output();

            // registra os resultados
            info('Um novo Backup de Arquivos foi iniciado no painel admin ' . $output);
            //return the results as a response to te ajax call
            echo $output;
        } catch (Exception $exception) {
            response($exception->getMessage(), 500);
        }
        return 'success';
    }

    /**
     * Create a backup
     */
    public function createDatabaseOnly()
    {
        try {
            ini_set('max_execution_time', 900);
            // inicia o processo de backup
            Artisan::call('backup:run --only-db');
            $output = Artisan::output();

            // registra os resultados
            info('Um novo backup de banco de dados foi iniciado no painel admin ' . $output);
            //return the results as a response to te ajax call
            echo $output;
        } catch (Exception $exception) {
            response($exception->getMessage(), 500);
        }
        return 'success';
    }

    /**
     * Download a backup
     * @param Request $request
     * @return BinaryFileResponse|void
     */
    public function download(Request $request)
    {
        $disk = Storage::disk($request->input('disk'));
        $file_name = $request->input('file_name');
        $adapter = $disk->getDriver()->getAdapter();

        if ($adapter instanceof Local) {
            $storage_path = $disk->getDriver()->getAdapter()->getPathPrefix();

            if ($disk->exists($file_name)) {
                return response()->download($storage_path . $file_name);
            } else {
                return abort(404, 'O arquivo de backup não existe.');
            }
        }
        return abort(404, 'Apenas downloads do sistema de arquivos local são suportados.');
    }

    /**
     * Deletes a backup
     * @param Request $request
     * @return string|void
     */
    public function delete(Request $request)
    {
        $disk = Storage::disk($request->input('disk'));
        $file_name = $request->input('file_name');
        $adapter = $disk->getDriver()->getAdapter();

        if ($adapter instanceof Local) {
            if ($disk->exists($file_name)) {
                $disk->delete($file_name);
                return 'success';
            } else {
                return abort(404, 'O arquivo de backup não existe.');
            }
        }
        return abort(404, 'O arquivo de backup não existe.');
    }
}
