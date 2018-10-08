<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(RoleTableSeeder::class);
        // $this->call(UserTableSeeder::class);
        // $this->call(AccountingTreeLevelOneTableSeeder::class);
        // $this->call(AccountingTreeLevelTwoTableSeeder::class);
        // $this->call(CurrentAssetsTableSeeder::class);
        // $this->call(CurrentLiabilitiesTableSeeder::class);
        // $this->call(FixedAssetsTableSeeder::class);

        $this->call(CustodyAndAdvancesTableSeeder::class);
        $this->call(FriendshipFundsTableSeeder::class);
        $this->call(LevelThreeGeneralExpensesTableSeeder::class);
        $this->call(LevelFourGeneralExpensesTableSeeder::class);
        $this->call(PenalitiesFundsTableSeeder::class);
        $this->call(SocialInsurancesTableSeeder::class);
        $this->call(SuppliersTableSeeder::class);
        $this->call(TreasuriesTableSeeder::class);
        
    }
}
