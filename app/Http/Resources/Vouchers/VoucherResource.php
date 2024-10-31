<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Voucher;
use Tests\TestCase;

class XmlContentTest extends TestCase
{
    public function test_it_can_register_voucher_with_series_number_type_and_currency()
    {
        // Obtener un usuario existente
        $user = User::first();

        // Si no hay usuarios en la base de datos, lanza una excepción
        if (!$user) {
            $this->fail('No hay usuarios en la base de datos.');
        }

        // Cargar el contenido del archivo XML
        $xmlContent = file_get_contents(base_path('tests/fixtures/sample_voucher.xml'));

        // Enviar la solicitud POST con el contenido del archivo XML
        $response = $this->actingAs($user)->postJson('/api/v1/vouchers', [
            'xml_content' => $xmlContent,
        ]);

        // Verificar que la respuesta tenga un estado 201 (creado)
        $response->assertStatus(201);

        // Verificar que los datos se hayan guardado en la base de datos
        $this->assertDatabaseHas('vouchers', [
            'series' => 'F001',
            'number' => '123456',
            'voucher_type' => '01',
            'currency' => 'PEN',
        ]);
    }
}
