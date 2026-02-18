<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Criar as Roles iniciais
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $empresaRole = Role::firstOrCreate(['name' => 'empresa']);
        $gerenteRole = Role::firstOrCreate(['name' => 'gerente']);
        $candidatoRole = Role::firstOrCreate(['name' => 'clientes']);

        // 2. Criar a Empresa Inicial (Tenant)
        $portal = Company::firstOrCreate(
            ['slug' => 'portalitaitinga'],
            [
                'name' => 'Portal Itaitinga',
                'is_active' => true,
            ]
        );

        // 3. Criar o Usuário Master
        $admin = User::firstOrCreate(
            ['email' => 'adolfoaugustor@gmail.com'],
            [
                'name' => 'Adolfo Aero Websites',
                'password' => Hash::make('senha123'), // Altera após o primeiro login
            ]
        );

        // 4. Vincular Usuário à Role e à Empresa
        if (!$admin->hasRole('super_admin')) {
            $admin->assignRole($superAdminRole);
        }

        // Vincular o admin à empresa no relacionamento Many-to-Many
        if (!$admin->companies()->where('company_id', $portal->id)->exists()) {
            $admin->companies()->attach($portal);
        }

        $this->command->info('Ambiente do Portal Itaitinga configurado com sucesso!');
        $this->command->warn('Login: adolfoaugustor@gmail.com | Senha: senha123');
        $this->command->info('URL de acesso: http://localhost/admin/portalitaitinga');
    }
}
