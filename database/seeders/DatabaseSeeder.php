<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // =====================================================================
        // 0. USUARIO ADMINISTRADOR PARA LARAVEL BREEZE
        // =====================================================================
        User::updateOrCreate(
            ['email' => 'admin@kromastudio.com'],
            [
                'name'              => 'Director Creativo UI/UX',
                'password'          => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // =====================================================================
        // 1. TABLA PADRE 1: CATEGORIES (Disciplinas de Diseño)
        // =====================================================================
        $catUiUx = Category::create([
            'name'        => 'Diseño UI/UX & Producto',
            'slug'        => 'diseno-ui-ux-producto',
            'color_hex'   => '#6366F1', // Indigo
            'icon_name'   => 'layout-grid',
            'description' => 'Investigación de usuarios, arquitectura de información y diseño de interfaces para aplicaciones móviles y web.',
        ]);

        $catDesignSystem = Category::create([
            'name'        => 'Design Systems',
            'slug'        => 'design-systems',
            'color_hex'   => '#10B981', // Emerald
            'icon_name'   => 'layers',
            'description' => 'Creación de librerías de componentes escalables, tokens de diseño y documentación entre diseño e ingeniería.',
        ]);

        $catBranding = Category::create([
            'name'        => 'Identidad Visual & Branding',
            'slug'        => 'identidad-visual-branding',
            'color_hex'   => '#F43F5E', // Rose
            'icon_name'   => 'sparkles',
            'description' => 'Construcción de sistemas visuales, dirección de arte, tipografía y lenguaje de marca para entornos digitales.',
        ]);

        $catWebDesign = Category::create([
            'name'        => 'Web Interactiva & E-Commerce',
            'slug'        => 'web-interactiva-ecommerce',
            'color_hex'   => '#F59E0B', // Amber
            'icon_name'   => 'globe',
            'description' => 'Experiencias web inmersivas orientadas a la conversión, accesibilidad y rendimiento visual.',
        ]);

        // =====================================================================
        // 2. TABLA PADRE 2: CLIENTS (Empresas y Startups)
        // =====================================================================
        $clientNova = Client::create([
            'company_name'  => 'NovaPay Fintech',
            'contact_name'  => 'Elena Rostova',
            'contact_email' => 'elena@novapay.io',
            'industry'      => 'Banca Digital & Fintech',
            'country'       => 'México',
            'website_url'   => 'https://novapay.example.com',
            'logo_url'      => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=400&q=80',
        ]);

        $clientVitalia = Client::create([
            'company_name'  => 'Vitalia HealthTech',
            'contact_name'  => 'Dr. Marco Tulio Vega',
            'contact_email' => 'mvega@vitaliahealth.com',
            'industry'      => 'Salud Digital & Telemedicina',
            'country'       => 'Colombia',
            'website_url'   => 'https://vitalia.example.com',
            'logo_url'      => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=400&q=80',
        ]);

        $clientNomad = Client::create([
            'company_name'  => 'Nomad Brew Roasters',
            'contact_name'  => 'Sofía Castellanos',
            'contact_email' => 'sofia@nomadbrew.co',
            'industry'      => 'Gastronomía & Retail D2C',
            'country'       => 'Costa Rica',
            'website_url'   => 'https://nomadbrew.example.com',
            'logo_url'      => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=400&q=80',
        ]);

        $clientKinetix = Client::create([
            'company_name'  => 'Kinetix Cloud AI',
            'contact_name'  => 'David Morales',
            'contact_email' => 'dmorales@kinetix.ai',
            'industry'      => ' Inteligencia Artificial & SaaS',
            'country'       => 'Estados Unidos',
            'website_url'   => 'https://kinetix.example.com',
            'logo_url'      => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=400&q=80',
        ]);

        // =====================================================================
        // 3. CASO DE ESTUDIO 1 + ENTREGABLES (Tabla 4) + TESTIMONIOS (Tabla 5)
        // =====================================================================
        $project1 = Project::create([
            'category_id'    => $catUiUx->id,
            'client_id'      => $clientNova->id,
            'title'          => 'Rediseño de SuperApp Bancaria NovaPay 3.0',
            'slug'           => 'rediseno-superapp-bancaria-novapay-3-0',
            'summary'        => 'Reducción del 42% en la tasa de abandono durante el onboarding biométrico y nuevo flujo de transferencias en 2 toques.',
            'challenge_text' => 'Los usuarios abandonaban el registro en el paso de verificación de identidad debido a formularios extensos de 14 campos, textos legales confusos y falta de retroalimentación visual al escanear su documento oficial.',
            'solution_text'  => 'Reestructuramos el flujo en micro-pasos progresivos con captura guiada en tiempo real, modo oscuro nativo de alto contraste (WCAG AAA) y un panel principal personalizable mediante tarjetas modulares.',
            'cover_image'    => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=1200&q=80',
            'figma_url'      => 'https://www.figma.com/community',
            'live_url'       => 'https://novapay.example.com',
            'published_at'   => '2026-08-15',
            'is_featured'    => true,
        ]);

        $project1->deliverables()->createMany([
            [
                'title'      => 'Mapa de Empatía y User Journey del Onboarding',
                'image_url'  => 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&w=900&q=80',
                'stage'      => 'Research',
                'sort_order' => 1,
            ],
            [
                'title'      => 'Arquitectura y Wireframes de Baja Fidelidad',
                'image_url'  => 'https://images.unsplash.com/photo-1581291518633-83b4ebd1d83e?auto=format&fit=crop&w=900&q=80',
                'stage'      => 'Wireframe',
                'sort_order' => 2,
            ],
            [
                'title'      => 'Sistema de Pantallas en Alta Fidelidad (Dark UI)',
                'image_url'  => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?auto=format&fit=crop&w=900&q=80',
                'stage'      => 'UI Design',
                'sort_order' => 3,
            ],
            [
                'title'      => 'Prototipo Interactivo con Micro-interacciones',
                'image_url'  => 'https://images.unsplash.com/photo-1618761714954-0b8cd0026356?auto=format&fit=crop&w=900&q=80',
                'stage'      => 'Prototype',
                'sort_order' => 4,
            ],
        ]);

        $project1->testimonials()->createMany([
            [
                'author_name' => 'Elena Rostova',
                'author_role' => 'VP of Product en NovaPay Fintech',
                'rating'      => 5,
                'comment'     => 'El equipo de Kroma Studio transformó por completo nuestra métrica de activación. En el primer mes tras el lanzamiento duplicamos las aperturas de cuenta completadas desde iOS y Android.',
                'is_approved' => true,
            ],
            [
                'author_name' => 'Rodrigo Salgado',
                'author_role' => 'Lead Mobile Engineer en NovaPay',
                'rating'      => 5,
                'comment'     => 'La entrega en Figma fue impecable: todos los componentes con Auto Layout, variables bien nombradas y estados de error documentados para el equipo de desarrollo.',
                'is_approved' => true,
            ],
        ]);

        // =====================================================================
        // 4. CASO DE ESTUDIO 2 + ENTREGABLES + TESTIMONIOS
        // =====================================================================
        $project2 = Project::create([
            'category_id'    => $catDesignSystem->id,
            'client_id'      => $clientVitalia->id,
            'title'          => 'Pulse DS: Sistema de Diseño Médico Multiplataforma',
            'slug'           => 'pulse-ds-sistema-diseno-medico-multiplataforma',
            'summary'        => 'Librería unificada de +90 componentes accesibles que aceleró en un 60% el lanzamiento de módulos clínicos.',
            'challenge_text' => 'Vitalia contaba con 4 aplicaciones web y móviles diseñadas por equipos distintos. Existían 11 estilos diferentes de botones, problemas críticos de contraste para médicos en guardias nocturnas y deuda técnica en CSS.',
            'solution_text'  => 'Creamos Pulse Design System basado en Design Tokens semánticos, componentes atómicos en Figma sincronizados con Storybook y guías estrictas de accesibilidad clínica.',
            'cover_image'    => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=1200&q=80',
            'figma_url'      => 'https://www.figma.com/community',
            'live_url'       => 'https://vitalia.example.com',
            'published_at'   => '2026-09-02',
            'is_featured'    => true,
        ]);

        $project2->deliverables()->createMany([
            [
                'title'      => 'Auditoría de Interfaz e Inventario de Tokens',
                'image_url'  => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=900&q=80',
                'stage'      => 'Research',
                'sort_order' => 1,
            ],
            [
                'title'      => 'Catálogo de Componentes Atómicos y Variantes',
                'image_url'  => 'https://images.unsplash.com/photo-1586717791821-3f44a563fa4c?auto=format&fit=crop&w=900&q=80',
                'stage'      => 'UI Design',
                'sort_order' => 2,
            ],
            [
                'title'      => 'Dashboard de Telemedicina Construido con Pulse DS',
                'image_url'  => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=900&q=80',
                'stage'      => 'Prototype',
                'sort_order' => 3,
            ],
        ]);

        $project2->testimonials()->create([
            'author_name' => 'Dr. Marco Tulio Vega',
            'author_role' => 'Chief Medical Officer en Vitalia',
            'rating'      => 5,
            'comment'     => 'Nuestros médicos ahora pueden consultar historiales clínicos y emitir recetas digitales en la mitad del tiempo y sin fatiga visual.',
            'is_approved' => true,
        ]);

        // =====================================================================
        // 5. CASO DE ESTUDIO 3 + ENTREGABLES + TESTIMONIOS
        // =====================================================================
        $project3 = Project::create([
            'category_id'    => $catWebDesign->id,
            'client_id'      => $clientNomad->id,
            'title'          => 'Experiencia E-Commerce & Suscripción Nomad Brew',
            'slug'           => 'experiencia-ecommerce-suscripcion-nomad-brew',
            'summary'        => 'Tienda interactiva con recomendador sensorial de café de especialidad que incrementó el ticket promedio en 35%.',
            'challenge_text' => 'Los compradores primerizos no sabían qué grano elegir entre más de 25 variedades de tueste y molienda, provocando una alta tasa de rebote en las páginas de producto.',
            'solution_text'  => 'Diseñamos un cuestionario interactivo de 4 pasos ("Encuentra tu perfil de taza"), empaques ilustrados en 3D y un configurador visual de suscripción mensual sin fricción.',
            'cover_image'    => 'https://images.unsplash.com/photo-1497935586351-b67a49e012bf?auto=format&fit=crop&w=1200&q=80',
            'figma_url'      => 'https://www.figma.com/community',
            'live_url'       => 'https://nomadbrew.example.com',
            'published_at'   => '2026-09-20',
            'is_featured'    => false,
        ]);

        $project3->deliverables()->createMany([
            [
                'title'      => 'Wireframes del Quiz Sensorial de Café',
                'image_url'  => 'https://images.unsplash.com/photo-1522542550221-31fd19575a2d?auto=format&fit=crop&w=900&q=80',
                'stage'      => 'Wireframe',
                'sort_order' => 1,
            ],
            [
                'title'      => 'Diseño Visual de Producto y Checkout Express',
                'image_url'  => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=900&q=80',
                'stage'      => 'UI Design',
                'sort_order' => 2,
            ],
        ]);

        $project3->testimonials()->create([
            'author_name' => 'Sofía Castellanos',
            'author_role' => 'Fundadora de Nomad Brew Roasters',
            'rating'      => 5,
            'comment'     => 'El quiz interactivo se convirtió en nuestro principal canal de ventas. Los clientes aman la estética editorial del sitio.',
            'is_approved' => true,
        ]);

        // =====================================================================
        // 6. CASO DE ESTUDIO 4 + ENTREGABLES + TESTIMONIOS
        // =====================================================================
        $project4 = Project::create([
            'category_id'    => $catBranding->id,
            'client_id'      => $clientKinetix->id,
            'title'          => 'Rebranding Global e Interfaz Analítica Kinetix AI',
            'slug'           => 'rebranding-global-interfaz-analitica-kinetix-ai',
            'summary'        => 'Nueva identidad visual generativa y dashboard de visualización de datos en tiempo real para modelos de IA.',
            'challenge_text' => 'Kinetix necesitaba dejar atrás la imagen genérica de startup tecnológica para posicionarse como una plataforma empresarial confiable ante clientes Fortune 500.',
            'solution_text'  => 'Desarrollamos un sistema de identidad dinámico inspirado en nodos neuronales, tipografía geométrica de alta legibilidad y un lenguaje de gráficas de datos oscuras.',
            'cover_image'    => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1200&q=80',
            'figma_url'      => 'https://www.figma.com/community',
            'live_url'       => 'https://kinetix.example.com',
            'published_at'   => '2026-10-05',
            'is_featured'    => true,
        ]);

        $project4->deliverables()->createMany([
            [
                'title'      => 'Manual de Identidad, Grilla Constructiva y Tipografía',
                'image_url'  => 'https://images.unsplash.com/photo-1626785774573-4b799315345d?auto=format&fit=crop&w=900&q=80',
                'stage'      => 'UI Design',
                'sort_order' => 1,
            ],
            [
                'title'      => 'Prototipo de Consola Analítica en Tiempo Real',
                'image_url'  => 'https://images.unsplash.com/photo-1504868584819-f8e8b4b6d7e3?auto=format&fit=crop&w=900&q=80',
                'stage'      => 'Prototype',
                'sort_order' => 2,
            ],
        ]);

        $project4->testimonials()->create([
            'author_name' => 'David Morales',
            'author_role' => 'CEO en Kinetix Cloud AI',
            'rating'      => 5,
            'comment'     => 'Cerramos nuestra ronda Serie A tres semanas después de presentar la nueva identidad y el prototipo funcional diseñado por Kroma Studio.',
            'is_approved' => true,
        ]);
    }
}