<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    // Временное хранилище: в ЛПР № 9 его заменит база данных. ITEMS = 7
    private function medicines(): array
    {
        return [
            ['id' => 1, 'code' => 'PS-0101', 'name' => 'Парацетамол', 'manufacturer' => 'Фармстандарт',
             'form' => 'таблетки', 'dosage_mg' => 500, 'price' => 45.00, 'by_prescription' => false],
            ['id' => 2, 'code' => 'PS-0102', 'name' => 'Ибупрофен', 'manufacturer' => 'Фармстандарт',
             'form' => 'таблетки', 'dosage_mg' => 400, 'price' => 120.50, 'by_prescription' => false],
            ['id' => 3, 'code' => 'SN-0201', 'name' => 'Амоксициллин', 'manufacturer' => 'Синтез',
             'form' => 'капсулы', 'dosage_mg' => 500, 'price' => 210.00, 'by_prescription' => true],
            ['id' => 4, 'code' => 'SN-0202', 'name' => 'Азитромицин', 'manufacturer' => 'Синтез',
             'form' => 'таблетки', 'dosage_mg' => 250, 'price' => 340.00, 'by_prescription' => true],
            ['id' => 5, 'code' => 'OZ-0301', 'name' => 'Лоратадин', 'manufacturer' => 'Озон',
             'form' => 'таблетки', 'dosage_mg' => 10, 'price' => 95.90, 'by_prescription' => false],
            ['id' => 6, 'code' => 'OZ-0302', 'name' => 'Омепразол', 'manufacturer' => 'Озон',
             'form' => 'капсулы', 'dosage_mg' => 20, 'price' => 150.00, 'by_prescription' => false],
            ['id' => 7, 'code' => 'PS-0103', 'name' => 'Цетиризин', 'manufacturer' => 'Фармстандарт',
             'form' => 'капли', 'dosage_mg' => 10, 'price' => 280.00, 'by_prescription' => false],
        ];
    }

    // GET /catalog?q=...&sort=...
    public function index(Request $request)
    {
        $medicines = collect($this->medicines());

        $search = $request->query('q');
        if ($search) {
            $medicines = $medicines->filter(fn ($m) => mb_stripos($m['name'], $search) !== false);
        }

        $sort = $request->query('sort', 'name');
        if (in_array($sort, ['name', 'dosage_mg', 'price'])) {
            $medicines = $medicines->sortBy($sort);
        }

        return view('catalog.index', [
            'title'     => 'Каталог препаратов',
            'medicines' => $medicines,
            'search'    => $search,
            'sort'      => $sort,
        ]);
    }

    // GET /catalog/3
    public function show(int $id)
    {
        $medicine = collect($this->medicines())->firstWhere('id', $id);
        abort_if(! $medicine, 404);

        return view('catalog.show', ['title' => $medicine['name'], 'medicine' => $medicine]);
    }

    // GET /catalog/code/PS-0101
    public function byCode(string $code)
    {
        $medicine = collect($this->medicines())->firstWhere('code', $code);
        abort_if(! $medicine, 404);

        return view('catalog.show', ['title' => $medicine['name'], 'medicine' => $medicine]);
    }

    // GET /catalog/manufacturer/Озон  или  /catalog/manufacturer
    public function byManufacturer(?string $manufacturer = null)
    {
        $all = collect($this->medicines());

        // ⭐ без параметра — список производителей, а не все записи
        if (! $manufacturer) {
            return view('catalog.manufacturers', [
                'title'         => 'Все производители',
                'manufacturers' => $all->pluck('manufacturer')->unique()->values(),
            ]);
        }

        return view('catalog.index', [
            'title'     => "Препараты: {$manufacturer}",
            'medicines' => $all->where('manufacturer', $manufacturer),
            'search'    => null,
            'sort'      => 'name',
        ]);
    }

    // ⭐ GET /catalog/stats
    public function stats()
    {
        $prices = collect($this->medicines())->pluck('price');

        return view('catalog.stats', [
            'title' => 'Статистика',
            'count' => $prices->count(),
            'avg'   => $prices->avg(),
            'min'   => $prices->min(),
            'max'   => $prices->max(),
        ]);
    }
}
