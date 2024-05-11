<?php

namespace Repositories;

use App\Models\PembelianModel;

use Illuminate\Support\Str;
class Pembelian {
    public function update ($request) {
        $db =PembelianModel::findOrFail($request->id);
        return (int)$db->update([
            'status'=>$request->status,
            'code'=>Str::random(16)
        ]);
    }
}
