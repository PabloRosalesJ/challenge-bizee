<?php declare(strict_types= 1);

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;


class RouteDefinition {
    public function __construct(private string $prefix, private array $middleware, private string $path, private string $name = '') {
        $this->build();
    }

    private function build(): void {
        Route::prefix($this->prefix)
        ->name($this->name)
        ->middleware($this->middleware)
        ->group(function () {
            foreach (scandir(base_path($this->path)) as $file) {
                if (!Str::contains($file, '.php'))
                    continue;

                $cleanFileName = Str::replace('.php', '', $file);
                $camelCaseToSpaces = self::camelCaseToSpaces($cleanFileName);
                $finalName = Str::slug($camelCaseToSpaces, '-', 'es');
                Route::prefix($finalName)->group(base_path("{$this->path}/{$file}"));
            }
        });
    }

    private static function camelCaseToSpaces($input): string {
        if (ctype_upper($input)) {
            return $input;
        }

        $output = preg_replace('/([A-Z])/', ' $1', $input);
        $output = ucfirst($output);
        return trim($output);
    }
}
