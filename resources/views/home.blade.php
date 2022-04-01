<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Emoji Calculator</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
            crossorigin="anonymous">

        <style>
            body {
                overflow: hidden;
            }
            .is-full-height {
                height: 100vh;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="row is-full-height align-items-center justify-content-center">
            <form method="GET" id="calculator_form" class="col-8">
                <div class="row">
                    <div class="col-md">
                        <label for="operand_1">Operand 1</label>
                        <input type="number" id="operand_1" name="operand_1" class="form-control">
                        <div id="operand_1_invalid_feedback" class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-3">
                        <label for="floatingSelect">Operator</label>
                        <select id="operator" class="form-select" name="operator">
                            <option value="" class="text-center">Choose an operator</option>
                            @foreach ($operator_emojis as $operator => $emoji)
                                <option value="{{ $operator }}" class="text-center">{!! $emoji !!}</option>
                            @endforeach
                        </select>
                        <div id="operator_invalid_feedback" class="invalid-feedback"></div>
                    </div>
                    <div class="col-md">
                        <label for="operand_2">Operand 2</label>
                        <input type="number" id="operand_2" name="operand_2" class="form-control">
                        <div id="operand_2_invalid_feedback" class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-1 mt-4">
                        <button type="submit" class="btn btn-primary">=</button>
                    </div>
                    <div class="col-md-1 mt-4">
                        <div id="result_spinner" class="spinner-border text-info d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="col-md">
                        <label for="result">Result</label>
                        <input type="number" id="result" class="form-control">
                    </div>
                </div>
            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous">
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
                crossorigin="anonymous">
        </script>
    </body>
</html>
