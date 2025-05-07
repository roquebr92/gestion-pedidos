<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;
use App\Models\PedidoLinea;


use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PedidoController extends Controller
{
    public function index()
    {
        // Recupera la empresa del usuario logueado
        $empresaId = Auth::user()->empresa_id;

        // Trae todos los pedidos de esa empresa, ordenados por fecha
        $pedidos = Pedido::with(['empresa','lineas'])
        ->where('empresa_id', $empresaId)
        ->orderBy('fecha','desc')
        ->get();

        return view('pedidos.index', compact('pedidos'));
    }
    
    public function show(Pedido $pedido)
    {
    // Solo permitir ver pedidos de la propia empresa
    $this->authorize('view', $pedido);
    return view('pedidos.show', compact('pedido'));
    abort_unless(Auth::user()->empresa_id === $pedido->empresa_id, 403);

    // Eager load
    $pedido->load('lineas');

    return view('pedidos.show', compact('pedido'));
    }
    /**
     * Muestra la tabla para generar etiquetas de un pedido.
     */
    /*public function etiquetas(Pedido $pedido)
    {
        // Carga las líneas asociadas ordenadas por número de línea
        $lineas = $pedido->lineas()->orderBy('linea')->get();
        return view('pedidos.etiquetas', compact('pedido', 'lineas'));
    }*/

    public function etiquetas(Pedido $pedido)
    {
        // Cargamos las líneas del pedido
        $pedido->load('lineas');
        return view('pedidos.etiquetas', compact('pedido'));
    }

    public function pdfEtiquetas(Pedido $pedido)
    {
        // Recoge todas las líneas para incluir sus QR
        $lineas = $pedido->lineas;

        // Crea el PDF (ajusta la vista a tu plantilla)
        $pdf = PDF::loadView('pedidos.pdf-etiquetas', compact('pedido', 'lineas'));

        // Retorna descarga
        return $pdf->download("etiquetas_pedido_{$pedido->numero}.pdf");
    }

    /**
     * Genera un sólo QR para esa línea (será un PDF o imagen).
     */
    public function generar(Pedido $pedido, PedidoLinea $linea)
{
    // Cargar la vista y pasar exactamente las variables 'pedido' y 'linea'
    $pdf = Pdf::loadView('pedidos.qr', compact('pedido', 'linea'))
              ->setPaper('a6', 'portrait')
              ->setOption('margin-top', 0)
              ->setOption('margin-bottom', 0);

    $filename = "Etiqueta_P{$pedido->numero}_L{$linea->linea}.pdf";
    return $pdf->download($filename);
}

    /**
     * Muestra (vista) un QR ya existente.
     */
    public function ver(Pedido $pedido, Linea $linea)
    {
        // Lógica de lectura si guardas el QR en disco, etc.
        return view('pedidos.qr', compact('pedido', 'linea'));
    }

    /**
     * Genera un PDF con todas las etiquetas de la comanda.
     */
    public function generarTodas(Pedido $pedido)
    {
        // Lógica que recorra $pedido->lineas y devuelva un PDF.
        // Asegúrate de cargar las líneas
        $pedido->load('lineas');

        $pdf = Pdf::loadView('pedidos.qr_all', compact('pedido'))
              ->setPaper('a4', 'portrait');

        $filename = "Etiquetas_Pedido_{$pedido->numero}.pdf";
        return $pdf->download($filename);
    }
    /**
     * Devuelve un PNG con el código QR para una línea de pedido.
     */
    public function qrImage(Pedido $pedido, PedidoLinea $linea): Response
    {
        // El texto u objeto que quieras codificar
        $payload = "PEDIDO:{$pedido->numero}|LÍNEA:{$linea->linea}";

        // Genera directamente el PNG
        $png = QrCode::format('png')
                    ->size(300)
                    ->generate($payload);

        // Retorna la respuesta con cabecera image/png
        return response($png, 200)
            ->header('Content-Type', 'image/png');
    }

   



    
}
