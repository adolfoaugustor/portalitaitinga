<?php

namespace Database\Seeders;

use App\Models\ClassifiedItem;
use App\Models\CulturalEvent;
use App\Models\JobVacancy;
use App\Models\LocalListing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'adolfoaugustor@gmail.com'],
            [
                'name' => 'Adolfo Aero Websites',
                'organization_type' => 'company',
                'is_super_admin' => true,
                'password' => Hash::make('senha123'),
            ]
        );
        
        if (app()->environment('local')) {
            $users = collect([
                ['email' => 'empresa1@portal.local', 'name' => 'Padaria Luz do Pao', 'organization_type' => 'company'],
                ['email' => 'loja1@portal.local', 'name' => 'Lojinha do Bairro', 'organization_type' => 'lojas'],
                ['email' => 'servico1@portal.local', 'name' => 'Studio Bela Vida', 'organization_type' => 'service_provider'],
                ['email' => 'autonomo1@portal.local', 'name' => 'Eletricista do Vale', 'organization_type' => 'informal_seller'],
                ['email' => 'empresa2@portal.local', 'name' => 'Mercado Nova Era', 'organization_type' => 'company'],
                ['email' => 'servico2@portal.local', 'name' => 'Delivery Fit Express', 'organization_type' => 'service_provider'],
            ]);

            $users->each(function (array $userData, int $index): void {
                $user = User::updateOrCreate(
                    ['email' => $userData['email']],
                    [
                        'name' => $userData['name'],
                        'organization_type' => $userData['organization_type'],
                        'is_super_admin' => false,
                        'password' => Hash::make('senha123'),
                    ]
                );

                $businessCategory = match ($userData['organization_type']) {
                    'company' => 'empresas',
                    'lojas' => 'lojas',
                    'service_provider' => 'servicos',
                    'informal_seller' => 'autonomo',
                    default => 'empresas',
                };

                LocalListing::updateOrCreate([
                    'user_id' => $user->id,
                ], [
                    'name' => $user->name,
                    'slug' => Str::slug($user->name.'-guia'),
                    'category' => $businessCategory,
                    'phone' => '(85) 9'.str_pad($index + 9000, 4, '0', STR_PAD_LEFT),
                    'phone_whatsapp' => '(85) 9'.str_pad($index + 9000, 4, '0', STR_PAD_LEFT),
                    'address' => "Rua do Comercio, ".($index + 10),
                    'neighborhood' => ['Centro', 'Jabuti', 'Ancuri', 'Parque Genezare', 'Nova Metrópole', 'Bela Vista'][$index],
                    'city' => 'Itaitinga',
                    'sector' => ucwords(str_replace('_', ' ', $userData['organization_type'])),
                    'services' => 'Atendimento local e entrega sob demanda.',
                    'responsible' => 'Responsavel '.($index + 1),
                    'cnpj' => $userData['organization_type'] === 'company' ? '12.345.678/0001-'.str_pad($index + 10, 2, '0', STR_PAD_LEFT) : null,
                    'show_cnpj' => $userData['organization_type'] === 'company',
                    'contact_link' => 'https://wa.me/5585'.str_pad($index + 9000, 8, '0', STR_PAD_LEFT),
                    'description' => $userData['name'].' oferece servicos locais de qualidade.',
                    'is_published' => true,
                ]);

                for ($eventIndex = 1; $eventIndex <= 3; $eventIndex++) {
                    CulturalEvent::updateOrCreate([
                        'user_id' => $user->id,
                        'slug' => Str::slug($user->name." evento ".$eventIndex),
                    ], [
                        'title' => "Evento {$eventIndex} - {$user->name}",
                        'event_date' => Carbon::now()->addDays($index * 2 + $eventIndex),
                        'neighborhood' => ['Centro', 'Jabuti', 'Ancuri', 'Parque Genezare', 'Nova Metrópole', 'Bela Vista'][$index],
                        'event_type' => ['show', 'feira', 'rodizio'][$eventIndex % 3],
                        'pricing_type' => $eventIndex % 2 === 0 ? 'pago' : 'gratuito',
                        'audience_type' => $eventIndex === 3 ? 'familia' : 'geral',
                        'organizer_name' => $user->name,
                        'location' => "Praça ".($index + 1),
                        'description' => "Apresentacao de {$user->name} para a comunidade local.",
                        'is_published' => true,
                    ]);
                }

                JobVacancy::updateOrCreate([
                    'user_id' => $user->id,
                    'slug' => Str::slug($user->name.' vaga'),
                ], [
                    'title' => "Assistente {$user->name}",
                    'store_name' => $user->name,
                    'location' => ['Centro', 'Jabuti', 'Ancuri', 'Parque Genezare', 'Nova Metrópole', 'Bela Vista'][$index],
                    'description' => "Vaga de emprego para assistente no {$user->name}.",
                    'is_published' => true,
                ]);

                ClassifiedItem::updateOrCreate([
                    'user_id' => $user->id,
                    'slug' => Str::slug($user->name.' classificado'),
                ], [
                    'title' => "Promoção {$user->name}",
                    'kind' => 'item',
                    'category' => 'Diversos',
                    'price' => 99.90 + $index * 10,
                    'neighborhood' => ['Centro', 'Jabuti', 'Ancuri', 'Parque Genezare', 'Nova Metrópole', 'Bela Vista'][$index],
                    'advertiser_name' => $user->name,
                    'whatsapp_number' => '(85) 9'.str_pad($index + 9200, 4, '0', STR_PAD_LEFT),
                    'description' => "Oferta especial do {$user->name}.",
                    'is_published' => true,
                ]);
            });

            $this->command->info('Seed complete: 6 organization users, guide local entries, classified and job vacancy items plus events created.');
            $this->command->info('All seeded organization users use password: senha123');
        }
    }
}
