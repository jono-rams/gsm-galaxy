<?php

namespace Tests\Feature;

use App\Models\FirmwareVariant;
use App\Models\Product;
use App\Models\User;
use App\Models\XpLog;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PhaseOneSchemaAndSeedTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_seeds_boutique_handsets_variants_and_users(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@mail.com',
            'role' => 'admin',
            'vip_tier' => 'Gold',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'michael.creator@email.com',
            'role' => 'user',
            'vip_tier' => 'Bronze',
        ]);

        $this->assertGreaterThanOrEqual(10, Product::count());
        $this->assertGreaterThanOrEqual(15, FirmwareVariant::count());

        $xiaomi = Product::where('model_name', 'Xiaomi 13T Pro (512GB)')->first();
        $this->assertNotNull($xiaomi);
        $this->assertSame('Xiaomi', $xiaomi->brand_name);
        $this->assertSame('IP68', $xiaomi->ip_rating);
        $this->assertTrue($xiaomi->has_ois);
        $this->assertSame(144, $xiaomi->display_refresh_hz);
        $this->assertCount(3, $xiaomi->firmwareVariants);

        $cnVariant = $xiaomi->firmwareVariants()->where('rom_type', 'CN')->first();
        $this->assertNotNull($cnVariant);
        $this->assertTrue($cnVariant->isChineseRom());
        $this->assertFalse($cnVariant->supports_band_4);
        $this->assertFalse($cnVariant->gms_preinstalled);
    }

    public function test_user_loyalty_relationships_and_xp_logs_persist(): void
    {
        $user = User::factory()->create([
            'xp_points' => 260,
            'vip_tier' => 'Silver',
        ]);

        $log = XpLog::create([
            'user_id' => $user->id,
            'action_type' => 'wizard_completed',
            'xp_awarded' => 50,
            'description' => 'Completed Guided AI Discovery Wizard',
        ]);

        $this->assertSame(5, $user->getVipDiscountPercentage());
        $this->assertCount(1, $user->xpLogs);
        $this->assertSame(50, $log->xp_awarded);
    }
}
