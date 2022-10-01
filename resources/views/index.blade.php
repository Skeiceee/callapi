<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>CallAPI</title>
</head>
<body>
    

    <div class="container d-flex justify-content-center mt-5">

        <div class="d-flex flex-column w-50">

            <form action="/traer/dolar" method="POST">
                @csrf
                <div class="form-group d-flex justify-content-between w-100">
                    <select class="form-control "name="mes" id="mes">
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>

                    <button class="btn btn-primary">Enviar</button>
                    
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="descargarExcel">
                    <label class="form-check-label" for="descargarExcel">
                        Descargar Excel
                    </label>
                </div>
            </form>
    
            <div class="mt-5 mb-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Fecha</th>
                            <th scope="col">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
    
                        @foreach ($dolarPorMes as $dolarDia)
                            <tr>
                                <td>{{ $dolarDia["Fecha"] }}</td>
                                <td>{{ $dolarDia["Valor"] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>


        </div>
        

    </div>


</body>
</html>