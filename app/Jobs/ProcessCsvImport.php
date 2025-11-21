<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProcessCsvImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function handle(): void
    {
        $csvContent = Storage::get($this->filePath);
        $lines = explode("\n", $csvContent);
        
        $updated = 0;
        $notFound = 0;
        $errors = [];

        foreach ($lines as $index => $line) {
            if ($index === 0) {
                continue;
            }

            if (empty(trim($line))) {
                continue;
            }

            try {
                $columns = str_getcsv($line, ';');
                
                if (count($columns) < 4) {
                    continue;
                }

                $reference = trim($columns[0]);
                $quantityStr = trim($columns[3]);
                
                $quantity = str_replace('.', '', $quantityStr);
                $quantity = str_replace(',', '.', $quantity);
                $quantity = floatval($quantity);

                $product = Product::where('reference', $reference)->first();

                if ($product) {
                    $product->update(['quantity' => $quantity]);
                    $updated++;
                    
                    Log::info("Product updated: {$reference} - Quantity: {$quantity}");
                } else {
                    $notFound++;
                    Log::warning("Product not found: {$reference}");
                }
            } catch (\Exception $e) {
                $errors[] = "Line {$index}: " . $e->getMessage();
                Log::error("Error processing line {$index}: " . $e->getMessage());
            }
        }

        Log::info("CSV Import completed. Updated: {$updated}, Not Found: {$notFound}, Errors: " . count($errors));

        Storage::delete($this->filePath);
    }
}
