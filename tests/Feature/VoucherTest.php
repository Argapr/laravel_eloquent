<?php

namespace Tests\Feature;

use App\Models\Voucher;
use Database\Seeders\VoucherSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VoucherTest extends TestCase
{
//    S: create voucher
        public function testCreateVoucher()
        {
            $voucher = new Voucher();
            $voucher->name = "Sample Voucher";
            $voucher->voucher_code = "212321342";
            $voucher->save();

            self::assertNotNull($voucher->id);
        }
//  E: create voucher

//    S: create voucher UUID
    public function testCreateVoucherUuid()
    {
        $voucher = new Voucher();
        $voucher->name = "Sample Voucher";
        $voucher->save();

        self::assertNotNull($voucher->id);
        self::assertNotNull($voucher->voucher_code);
    }
//  E: create voucher UUID

//  S:SoftDelete
        public function testSoftDelete()
        {
            $this->seed(VoucherSeeder::class);

            $voucher = Voucher::where('name', '=', 'Sample Voucher')->first();
            $voucher->delete();

            $voucher = Voucher::where('name', '=', 'Sample Voucher')->first();
            self::assertNull($voucher);

            $voucher = Voucher::withTrashed()->where('name', '=', 'Sample Voucher')->first();
            self::assertNotNull($voucher);
        }
//  E: SoftDelete
}
