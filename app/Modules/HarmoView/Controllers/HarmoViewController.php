<?php

namespace App\Modules\HarmoView\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Instansi\Models\Instansi;
use Carbon\Carbon;

class HarmoViewController extends Controller
{
    public function compare(Request $request)
    {
        $request->validate([
            'ids' => 'required|string'
        ]);

        $ids = explode(',', $request->ids);

        if(count($ids) !== 2){
            return response()->json(['message'=>'Harus pilih 2 instansi'],422);
        }

        $instansis = Instansi::whereIn('id',$ids)
            ->where('status','approved')
            ->with(['profile','galleries'])
            ->get();

        if($instansis->count() !== 2){
            return response()->json(['message'=>'Instansi tidak valid'],404);
        }

        return $instansis->map(function($i){

            $jumlahFasilitas =
                $i->galleries->where('category','ruangan')->count()
              + $i->galleries->where('category','sdm')->count()
              + $i->galleries->where('category','layanan')->count();

            $durasiJam = 0;
            try{
                [$start,$end] = explode('-',str_replace(' ','',$i->jam_operasional));
                $durasiJam = max(0,(int)substr($end,0,2)-(int)substr($start,0,2));
            }catch(\Throwable $e){}

            $jumlahProgram = $i->profile && $i->profile->program_pembelajaran
                ? count(explode(',',$i->profile->program_pembelajaran))
                : 0;

            return [
                'id'=>$i->id,
                'nama'=>$i->nama,
                'biaya'=>$i->biaya_pendaftaran,
                'jumlah_fasilitas'=>$jumlahFasilitas,
                'jam_operasional'=>$durasiJam,
                'jumlah_program'=>$jumlahProgram,
            ];
        });
    }
}
