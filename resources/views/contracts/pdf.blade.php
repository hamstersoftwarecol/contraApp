<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contrato de Prestación de Servicios - {{ $contract->client->nombre_completo }}</title>
    <style>
        @page {
            margin: 2.5cm 2.5cm 2.5cm 2.5cm; /* Superior, Derecho, Inferior, Izquierdo */
            size: letter;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.6;
            color: #222222;
            margin: 0;
            padding: 0;
            text-align: justify;
            background-color: #ffffff;
        }

        /* Encabezado y pie de página */
        .header, .footer {
            text-align: center;
            font-size: 10pt;
            color: #444444;
            font-family: 'Times New Roman', Times, serif;
        }

        .header {
            position: running(header);
            border-bottom: 1px solid #cccccc;
            padding-bottom: 10px;
        }

        .footer {
            position: running(footer);
            border-top: 1px solid #cccccc;
            padding-top: 10px;
            font-style: italic;
        }

        @page {
            @top-center { content: element(header) }
            @bottom-center { content: element(footer) }
        }

        /* Título del contrato */
        .document-title {
            text-align: center;
            font-size: 18pt;
            font-weight: bold;
            margin: 30px 0 40px 0;
            color: #000000;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #000000;
            padding-bottom: 10px;
        }

        /* Sección de partes contratantes */
        .parties-container {
            margin-bottom: 30px;
        }

        /* Tablas */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 11pt;
        }

        table.parties-table th {
            background-color: #f8f8f8;
            color: #000000;
            font-weight: bold;
            text-align: center;
            padding: 12px;
            border: 1px solid #000000;
        }

        table.parties-table td {
            padding: 12px;
            border: 1px solid #000000;
            vertical-align: top;
        }

        table.conditions-table th {
            width: 30%;
            background-color: #f8f8f8;
            color: #000000;
            font-weight: bold;
            text-align: left;
            padding: 10px;
            border: 1px solid #000000;
        }

        table.conditions-table td {
            padding: 10px;
            border: 1px solid #000000;
        }

        /* Sección de condiciones */
        .conditions-title {
            font-size: 14pt;
            font-weight: bold;
            margin: 30px 0 15px 0;
            color: #000000;
            border-bottom: 1px solid #000000;
            padding-bottom: 5px;
            text-transform: uppercase;
        }

        /* Cláusulas */
        .clauses-container {
            margin-top: 30px;
        }

        .clause {
            margin-bottom: 20px;
        }

        .clause-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #000000;
        }

        .clause-text {
            margin-bottom: 10px;
            text-align: justify;
        }

        .clause-list {
            list-style-type: decimal;
            margin: 10px 0 10px 25px;
            padding-left: 10px;
        }

        .clause-list li {
            margin-bottom: 10px;
            padding-left: 5px;
        }

        /* Firmas */
        .signatures-container {
            margin-top: 60px;
            page-break-inside: avoid;
        }

        .signatures {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 60px;
        }

        .signature {
            width: 60%;
        }

        .signature-line {
            border-top: 1px solid #000000;
            margin-top: 5px;
            padding-top: 5px;
            text-align: center;
        }

        .signature-image {
            margin-top: 10px;
            text-align: center;
        }

        .signature-image img {
            max-width: 200px;
            max-height: 80px;
            border: 1px solid #cccccc;
            background: #ffffff;
            padding: 5px;
        }

        /* Numeración de páginas */
        .page-number:before {
            content: counter(page);
        }

        .page-count:before {
            content: counter(pages);
        }

        /* Estilos adicionales */
        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-bold {
            font-weight: bold;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .company-name {
            color: #000000;
            font-weight: bold;
            font-size: 11pt;
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100pt;
            color: rgba(200, 200, 200, 0.1);
            z-index: -1;
            pointer-events: none;
        }

        /* Párrafo introductorio */
        .intro-paragraph {
            margin-bottom: 30px;
            font-style: italic;
            border-left: 3px solid #000000;
            padding-left: 15px;
        }

        /* Párrafo de cierre */
        .closing-paragraph {
            margin: 40px 0;
            font-style: italic;
            text-align: justify;
        }

        /* Mejoras adicionales */
        .clause-title {
            text-decoration: underline;
        }

        .parties-table th, .conditions-table th {
            background-color: #f5f5f5;
        }

        /* Estilo para el sello de agua */
        .watermark {
            font-family: 'Times New Roman', Times, serif;
            opacity: 0.05;
        }
    </style>
</head>
<body>
    <!-- Encabezado que se repite en todas las páginas -->
    <div class="header">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="width: 20%; text-align: left; vertical-align: middle;">
                    <!-- Espacio para logo (opcional) -->
                    <div style="font-weight: bold; font-size: 14pt; text-transform: uppercase;">CONTRATO</div>
                </td>
                <td style="width: 60%; text-align: center; vertical-align: middle;">
                    <div class="company-name" style="font-size: 12pt; text-transform: uppercase;">{{ config('app.company_name', 'NOMBRE DE LA EMPRESA') }}</div>
                    <div style="font-size: 9pt;">CC: {{ config('app.company_nit', 'NIT DE LA EMPRESA') }}</div>
                </td>
                <td style="width: 20%; text-align: right; vertical-align: middle; font-size: 9pt;">
                    <div>Contrato No. {{ $contract->id }}</div>
                    <div>{{ $contract->fecha_inicio->format('d/m/Y') }}</div>
                </td>
            </tr>
        </table>
    </div>

    <!-- Pie de página que se repite en todas las páginas -->
    <div class="footer">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="width: 33%; text-align: left; vertical-align: middle; font-size: 9pt;">
                    {{ config('app.company_address', 'Dirección de la Empresa') }}
                </td>
                <td style="width: 33%; text-align: center; vertical-align: middle; font-size: 9pt;">
                    Tel: {{ config('app.company_phone', 'Teléfono de la Empresa') }}
                </td>
                <td style="width: 33%; text-align: right; vertical-align: middle; font-size: 9pt;">
                    Página <span class="page-number"></span> de <span class="page-count"></span>
                </td>
            </tr>
        </table>
        <div style="margin-top: 5px; font-size: 8pt; text-align: center; font-style: italic;">
            Este documento es confidencial y contiene información privilegiada. Prohibida su reproducción total o parcial.
        </div>
    </div>

    <!-- Marca de agua -->
    <div class="watermark">CONTRATO</div>

    <!-- Título del documento -->
    <h1 class="document-title">Contrato de Prestación de Servicios para Desarrollo de Software</h1>

    <!-- Párrafo introductorio -->
    <p class="intro-paragraph">Entre los suscritos a saber, por una parte, <span class="text-bold text-uppercase">{{ $contract->client->nombre_completo }}</span>, identificado con {{ $contract->client->tipo_identificacion }} número {{ $contract->client->cedula }}, quien en adelante se denominará <span class="text-bold">EL CONTRATANTE</span>, y por otra parte, <span class="text-bold text-uppercase">{{ config('app.company_name', 'NOMBRE DE LA EMPRESA') }}</span>, identificada con NIT {{ config('app.company_nit', 'NIT DE LA EMPRESA') }}, quien en adelante se denominará <span class="text-bold">EL CONTRATISTA</span>, ambos debidamente identificados como aparece al pie de sus firmas, han convenido celebrar el presente contrato de prestación de servicios profesionales, el cual se regirá por las siguientes cláusulas:</p>

    <!-- Sección de partes contratantes -->
    <div class="parties-container">
        <table class="parties-table">
            <tr>
                <th width="50%">CONTRATANTE</th>
                <th width="50%">CONTRATISTA</th>
            </tr>
            <tr>
                <td>
                    <span class="text-bold text-uppercase">{{ $contract->client->nombre_completo }}</span><br>
                    <strong>Identificación:</strong> {{ $contract->client->tipo_identificacion }} {{ $contract->client->cedula }}<br>
                    <strong>Dirección:</strong> {{ $contract->client->direccion }}<br>
                    <strong>Teléfono:</strong> {{ $contract->client->telefono }}
                </td>
                <td>
                    <span class="text-bold text-uppercase">{{ config('app.company_name', 'Nombre de la Empresa') }}</span><br>
                    <strong>CC:</strong> {{ config('app.company_nit', 'NIT de la Empresa') }}<br>
                    <strong>Dirección:</strong> {{ config('app.company_address', 'Dirección de la Empresa') }}<br>
                    <strong>Teléfono:</strong> {{ config('app.company_phone', 'Teléfono de la Empresa') }}
                </td>
            </tr>
        </table>
    </div>

    <!-- Sección de condiciones contractuales -->
    <h2 class="conditions-title">CONDICIONES CONTRACTUALES</h2>

    <div class="conditions-container">
        <table class="conditions-table">
            <tr>
                <th>Objeto del Contrato</th>
                <td>{{ $contract->descripcion ?? 'Desarrollo de software y servicios relacionados' }}</td>
            </tr>
            <tr>
                <th>Valor del Contrato</th>
                <td>${{ number_format($contract->monto_total, 2, ',', '.') }} <span class="text-bold">M/CTE</span></td>
            </tr>
            <tr>
                <th>Número de Cuotas</th>
                <td>{{ $contract->numero_cuotas }}</td>
            </tr>
            <tr>
                <th>Valor por Cuota</th>
                <td>${{ number_format($contract->monto_cuota, 2, ',', '.') }} <span class="text-bold">M/CTE</span></td>
            </tr>
            <tr>
                <th>Fecha de Inicio</th>
                <td>{{ $contract->fecha_inicio->format('d') }} de {{ trans('dates.months.' . $contract->fecha_inicio->format('n')) }} de {{ $contract->fecha_inicio->format('Y') }}</td>
            </tr>
        </table>
    </div>

    <!-- Cláusulas del contrato -->
    <div class="clauses-container">
        <div class="clause">
            <p class="clause-title">CLÁUSULA PRIMERA. OBJETO Y ACTIVIDADES A DESARROLLAR:</p>
            <p class="clause-text">EL CONTRATISTA se compromete para con EL CONTRATANTE, a cumplir con el servicio descrito en las CONDICIONES CONTRACTUALES, así como aquellas actividades inherentes al desarrollo de este.</p>
            <p class="clause-text">De la misma manera, EL CONTRATISTA realizará y prestará sus servicios conservando su autonomía técnica y administrativa e independencia, sin subordinación de ninguna naturaleza en cuanto a tiempo y modo de realizar su actividad en las gestiones que EL CONTRATANTE le encomiende, solamente se comprometerá a destinar el tiempo suficiente para ejecución de las actividades antes mencionadas.</p>
        </div>

        <div class="clause">
            <p class="clause-title">CLÁUSULA SEGUNDA. DURACIÓN:</p>
            <p class="clause-text">LAS PARTES han definido que la duración del presente contrato será la indicada en las CONDICIONES CONTRACTUALES.</p>
            <p class="clause-text">PARÁGRAFO PRIMERO: SUSPENSIÓN. El plazo para la ejecución del objeto del presente contrato podrá ser suspendido por mutuo acuerdo entre LAS PARTES. Unilateralmente, sólo podrá suspenderse por causa extraña, fuerza mayor y caso fortuito debidamente comprobado. En caso de reanudación de la ejecución del objeto del presente contrato, los plazos indicados en este contrato se prorrogarán por un tiempo igual al de la suspensión. En caso de no poder superarse esta causal, se configuraría la terminación de este contrato, sin que dicha terminación genere indemnización a favor de ninguna de LAS PARTES.</p>
            <p class="clause-text">PARÁGRAFO SEGUNDO: El contrato podrá ser renovado.</p>
        </div>

        <div class="clause">
            <p class="clause-title">CLÁUSULA TERCERA. VALOR DEL CONTRATO Y FORMA DE PAGO:</p>
            <p class="clause-text">EL CONTRATANTE pagará al EL CONTRATISTA la suma indicada en las CONDICIONES CONTRACTUALES por los servicios descritos en el presente contrato en la forma allí también descrita, una vez hayan sido efectivamente prestados y hayan sido recibidos a satisfacción por EL CONTRATANTE.</p>
            <p class="clause-text">Para el pago de esta, EL CONTRATISTA deberá radicar ante EL CONTRATANTE la factura o cuenta de cobro correspondiente, adjuntando la respectiva constancia de pago de aportes a la seguridad social integral.</p>
            <p class="clause-text">En caso de prórroga del contrato, cada año LAS PARTES definirán de mutuo acuerdo el incremento de los honorarios.</p>
        </div>

        <div class="clause">
            <p class="clause-title">CLÁUSULA CUARTA. AUTORIZACIÓN DE RETENCIÓN:</p>
            <p class="clause-text">EL CONTRATANTE podrá retener total o parcialmente las sumas pendientes de pago a favor del CONTRATISTA, en caso de que éste no hubiere aportado las garantías pactada en el contrato; las constancias de aportes a la seguridad social integral o hubiere desarrollado defectuosamente la labor encomendada o no hubiere devuelto aquellos elementos, herramientas o equipos que fueron suministrados por EL CONTRATANTE a EL CONTRATISTA para la ejecución del objeto del presente contrato. En todo caso EL CONTRATANTE deberá pagar el valor retenido a EL CONTRATISTA, cuando este último subsane, corrija y/o cumpla con las obligaciones, cargas o prestaciones pendientes por ejecutar.</p>
        </div>

        <div class="clause">
            <p class="clause-title">CLÁUSULA QUINTA. OBLIGACIONES DEL CONTRATISTA:</p>
            <ol class="clause-list">
                <li>DISPONIBILIDAD Y CONTINUIDAD EN LA PRESTACIÓN DEL SERVICIO: EL CONTRATISTA se obliga a garantizar durante la duración del contrato, la disponibilidad para la prestación del servicio.</li>
                <li>INFORMES: EL CONTRATISTA se compromete a suministrar la información solicitada por EL CONTRATANTE, así como aquellos hechos o circunstancias, previstas o imprevistas, sobrevinientes o no, que dada su importancia deban ser conocida por EL CONTRATANTE, así como aquella que pueda influir negativa o positivamente en el desarrollo y ejecución del objeto del presente contrato. Mantener informado a EL CONTRATANTE del desarrollo del trabajo encomendado, asistir a las reuniones a las que sea convocado, y en general, rendir los informes, aclararlos, adicionarlos y complementarlos de manera oportuna.</li>
                <li>DEVOLUCIÓN: Devolver a la terminación de los servicios objeto del contrato, o cuando le sea solicitado por EL CONTRATANTE, la totalidad de documentos o información que le sean entregados, así como los bienes que le fueren facilitados para cumplir a cabalidad con sus obligaciones.</li>
                <li>RESPONSABILIDAD: EL CONTRATISTA será responsable frente a EL CONTRATANTE por los daños y perjuicios causados con ocasión de la prestación de sus servicios profesionales.</li>
                <li>PERSONAL Y RECURSOS DISPUESTOS PARA EL DESARROLLO DEL CONTRATO: EL CONTRATISTA se obliga a emplear personal idóneo para la prestación del servicio, a quienes deberá instruir adecuadamente para el desarrollo de las labores encomendadas, y respecto de quienes deberá cumplir con las obligaciones laborales, en especial el desarrollo de las labores propias del Sistema de Gestión de Seguridad y Salud en el Trabajo, así como las de seguridad social integral, verificando que todo el personal involucrado cuente con afiliación y efectúe los aportes al sistema integral de seguridad social.</li>
                <li>USO DE MARCA: EL CONTRATISTA no podrá utilizar, sin previa autorización escrita de EL CONTRATANTE, el nombre y marcas asociados al mismo, con fines de mercadeo, publicidad y de cualquier otra actividad.</li>
            </ol>
        </div>

        <div class="clause">
            <p class="clause-title">CLÁUSULA SEXTA. OBLIGACIONES DEL CONTRATANTE:</p>
            <ol class="clause-list">
                <li>PAGO DE LOS HONORARIOS: de conformidad con el valor indicado en las CONDICIONES CONTRACTUALES.</li>
                <li>SUMINISTRO DE INFORMACIÓN: proveer toda la información y colaboración técnica que requiera EL CONTRATISTA, para la realización de la labor encomendada.</li>
                <li>REPORTE DE DEFICIENCIAS EN EL SERVICIO: Reportar a EL CONTRATISTA en forma oportuna, las deficiencias o anomalías que detecte en el desarrollo del objeto contractual, así como las sugerencias que estime convenientes sobre los servicios prestados y sobre posibles mejoras al mismo.</li>
                <li>COMUNICACIONES: Atender con diligencia las inquietudes que presente EL CONTRATISTA y comunicar los procesos establecidos para garantizar la prestación de los servicios.</li>
            </ol>
        </div>

        <div class="clause">
            <p class="clause-title">CLÁUSULA SÉPTIMA. CONFIDENCIALIDAD:</p>
            <p class="clause-text">LAS PARTES se obligan a guardar absoluta reserva de la información y documentos que en virtud del presente contrato llegasen a conocer. Estas se obligan a no revelar a terceras personas, la información confidencial que reciban en ejecución o con ocasión del presente vínculo contractual y, en consecuencia, se obligan a mantenerla de manera confidencial y privada y a protegerla para evitar su divulgación, ejerciendo el mismo grado de control que utilizarían para proteger la información confidencial de su propiedad. LAS PARTES no utilizarán la información confidencial para fines comerciales y sólo la utilizarán para efectos de este contrato. Esta obligación de no revelar la información confidencial estará vigente durante el término del contrato y cinco (5) años más.</p>
            <p class="clause-text">Esta obligación no aplicará o cesará cuando: (a) la información hubiere sido conocida previamente, de manera directa o indirecta, libre, legal y espontáneamente, por cualquiera de LAS PARTES; (b) la información sea de dominio público; (c) esta sea divulgada para atender un requerimiento legal de autoridad competente, previo informe a la otra parte; (d) por autorización expresa de la otra parte.</p>
        </div>

        <div class="clause">
            <p class="clause-title">CLÁUSULA OCTAVA. TERMINACIÓN DEL CONTRATO:</p>
            <p class="clause-text">El contrato podrá terminarse por cualquiera de las siguientes causales:</p>
            <ol class="clause-list">
                <li>De manera unilateral dando previo aviso con 30 días calendario de antelación, sin que por ello de lugar al pago de indemnización o sanción alguna a favor de la otra parte.</li>
                <li>Por mutuo acuerdo entre LAS PARTES.</li>
                <li>Por presentarse la inejecución total, parcial o la ejecución tardía o defectuosa, o un incumplimiento de las obligaciones pactadas en este contrato y sus anexos.</li>
                <li>Por la alteración o manipulación no autorizada de equipos y/o información de EL CONTRATANTE por parte del personal de EL CONTRATISTA, cuando haya lugar a ello.</li>
                <li>En caso de que alguna de LAS PARTES, sus accionistas, directivos y representantes legales llegaren a ser condenados por delitos graves o ser incluidos en listas restrictivas.</li>
            </ol>
            <p class="clause-text">PARÁGRAFO: En caso de terminación anticipada de los servicios, EL CONTRATISTA se compromete a transferir ordenadamente a EL CONTRATANTE los servicios, funciones y operaciones ejecutados.</p>
        </div>

        <div class="clause">
            <p class="clause-title">CLÁUSULA NOVENA. SOLUCIÓN DE PROBLEMAS:</p>
            <p class="clause-text">Cualquier situación relacionada con este contrato se intentará solucionar por la vía del arreglo directo entre LAS PARTES, en un plazo no mayor a 30 días, en caso de no lograrlo, serán libres de acudir ante la justicia ordinaria de la República de Colombia u otro Mecanismo Alternativo de Solución de Conflictos.</p>
        </div>

        <div class="clause">
            <p class="clause-title">CLÁUSULA DÉCIMA. PROTECCIÓN DE DATOS PERSONALES:</p>
            <p class="clause-text">Debe entenderse por base de datos, el conjunto organizado de datos personales que pueda ser objeto de cualquier operación o conjunto de operaciones en los términos de las leyes 1266 de 2008, 1581 de 2012 y demás normas aplicables. Las partes se comprometen a cumplir con todas las disposiciones legales sobre protección de datos personales.</p>
        </div>

        <div class="clause">
            <p class="clause-title">CLÁUSULA DÉCIMA PRIMERA. PROHIBICIÓN DE CESIÓN:</p>
            <p class="clause-text">LAS PARTES no podrán ceder parcial ni totalmente la ejecución del presente contrato a un tercero, ni las obligaciones y derechos derivados del mismo, salvo autorización previa, expresa y escrita de la otra Parte.</p>
        </div>

        <div class="clause">
            <p class="clause-title">CLÁUSULA DÉCIMA SEGUNDA. NULIDAD PARCIAL:</p>
            <p class="clause-text">La relación comercial y obligaciones derivadas de este Acuerdo Comercial se regirán e interpretarán de acuerdo con las leyes de la República de Colombia. Si cualquier disposición fuera considerada nula, ilegal o no exigible, de manera parcial, la validez, legalidad y exigibilidad del resto de las disposiciones no se verá afectada.</p>
        </div>

        <div class="clause">
            <p class="clause-title">CLÁUSULA DÉCIMA TERCERA. INDEPENDENCIA DE LAS PARTES:</p>
            <p class="clause-text">En ejecución del presente contrato, ambas partes actuarán por su propia cuenta, con absoluta autonomía e independencia técnica administrativa y directiva. De esta manera, ninguna de ellas estará sujeta a subordinación laboral alguna en virtud del presente contrato.</p>
        </div>

        <div class="clause">
            <p class="clause-title">CLÁUSULA DÉCIMA CUARTA. DERECHOS DE PROPIEDAD INTELECTUAL:</p>
            <p class="clause-text">LAS PARTES declaran que son titulares de los derechos de propiedad intelectual sobre los activos intangibles que aportarán o utilizarán para el desarrollo del presente contrato. La titularidad sobre las obras resultantes corresponderá a LAS PARTES según sus aportes, y deberá formalizarse por escrito.</p>
        </div>

        <div class="clause">
            <p class="clause-title">CLÁUSULA DÉCIMA QUINTA. TRATAMIENTO DE CAUSA EXTRAÑA:</p>
            <p class="clause-text">En caso de circunstancias extraordinarias que alteren el equilibrio económico del contrato, las partes iniciarán una etapa de renegociación. Si no se llega a un acuerdo en un mes, el contrato podrá terminarse sin indemnización.</p>
        </div>

        <div class="clause">
            <p class="clause-title">CLÁUSULA DÉCIMA SEXTA. USO DE SISTEMAS INFORMÁTICOS:</p>
            <p class="clause-text">EL CONTRATISTA se compromete a usar los sistemas informáticos de EL CONTRATANTE únicamente para los fines del contrato y respetando todas las políticas de seguridad.</p>
        </div>

        <div class="clause">
            <p class="clause-title">CLÁUSULA DÉCIMA SÉPTIMA. ESTIPULACIONES CONTRACTUALES ANTERIORES:</p>
            <p class="clause-text">Las partes manifiestan que no reconocerán validez a estipulaciones verbales relacionadas con el presente contrato, el cual constituye el acuerdo completo e íntegro entre ellas.</p>
        </div>

        <div class="clause">
            <p class="clause-title">CLÁUSULA DÉCIMA OCTAVA. LEY APLICABLE:</p>
            <p class="clause-text">La ley aplicable del presente contrato será la colombiana.</p>
        </div>

        <!-- Párrafo de cierre -->
        <p class="closing-paragraph">Con la firma del presente documento se reemplaza cualquier otro acuerdo verbal o escrito. Para constancia y en señal de aceptación, LAS PARTES suscriben el presente documento en el municipio de {{ config('app.company_city', 'Ciudad') }} el día {{ now()->format('d') }} de {{ trans('dates.months.' . now()->format('n')) }} de {{ now()->format('Y') }}.</p>

        <!-- Sección de firmas -->
        <div class="signatures-container">
            <div class="text-center" style="margin-bottom: 30px;">
                <p style="font-style: italic; font-size: 11pt;">En constancia de lo anterior, firman las partes en la ciudad de {{ config('app.company_city', 'Ciudad') }}:</p>
            </div>

            <div class="signatures" style="display: flex; flex-direction: row; justify-content: space-between; align-items: flex-start; gap: 40px;">
                <!-- Firma del CONTRATANTE -->
                <div class="signature" style="width: 45%; text-align: center;">
                    <div class="signature-line">
                        @if($contract->firma)
                            <div class="signature-image">
                                <img src="{{ $contract->firma }}" alt="Firma del cliente">
                            </div>
                        @endif
                        <span class="text-bold text-uppercase">EL CONTRATANTE</span><br>
                        <span class="text-uppercase">{{ $contract->client->nombre_completo }}</span><br>
                        {{ $contract->client->tipo_identificacion }} {{ $contract->client->cedula }}<br>
                        <span style="font-size: 10pt; font-style: italic;">{{ $contract->client->direccion ?? 'Dirección' }}</span>
                    </div>
                </div>

                <!-- Firma del CONTRATISTA -->
                <div class="signature" style="width: 45%; text-align: center;">
                    <div class="signature-line">
                        <div class="signature-image">
                            <img src="{{ public_path('images/firma.png') }}" alt="Firma del contratista">
                        </div>
                        <span class="text-bold text-uppercase">EL CONTRATISTA</span><br>
                        <span class="text-uppercase">{{ config('app.company_name', 'Nombre de la Empresa') }}</span><br>
                        CC: {{ config('app.company_nit', 'NIT de la Empresa') }}<br>
                        <span style="font-size: 10pt; font-style: italic;">{{ config('app.company_address', 'Dirección de la Empresa') }}</span>
                    </div>
                </div>
            </div>

            <!-- Sello notarial (opcional) -->
            <div style="margin-top: 80px; text-align: center; border: 1px solid #000; padding: 10px; width: 50%; margin-left: auto; margin-right: auto; font-size: 10pt; font-style: italic;">
                <p style="margin: 0;">Espacio reservado para autenticación notarial</p>
            </div>
        </div>
    </div>
</body>
</html>