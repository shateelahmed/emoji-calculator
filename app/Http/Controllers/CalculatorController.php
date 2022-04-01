<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use Illuminate\Support\Facades\Log;

class CalculatorController extends Controller
{
    private const OPERATOR_ADDITION = '+';
    private const OPERATOR_SUBTRACTION = '-';
    private const OPERATOR_MULTIPLICATION = '*';
    private const OPERATOR_DIVISION = '/';

    private const EMOJI_ADDITION = '&#x1F47D;';
    private const EMOJI_SUBTRACTION = '&#x1F480;';
    private const EMOJI_MULTIPLICATION = '&#x1F47B;';
    private const EMOJI_DIVISION = '&#x1F631;';

    private const OPERATOR_EMOJIS = [
        self::OPERATOR_ADDITION => self::EMOJI_ADDITION,
        self::OPERATOR_SUBTRACTION => self::EMOJI_SUBTRACTION,
        self::OPERATOR_MULTIPLICATION => self::EMOJI_MULTIPLICATION,
        self::OPERATOR_DIVISION => self::EMOJI_DIVISION,
    ];

    private const REQ_PARAM_OPERAND_1 = 'operand_1';
    private const REQ_PARAM_OPERATOR = 'operator';
    private const REQ_PARAM_OPERAND_2 = 'operand_2';

    public function index()
    {
        return view('home', [
            'operator_emojis' => self::OPERATOR_EMOJIS,
        ]);
    }

    private static function isDivisionByZero(Request $request)
    {
        if (
            $request->{self::REQ_PARAM_OPERATOR} == self::OPERATOR_DIVISION
            && $request->{self::REQ_PARAM_OPERAND_2} == 0
        ) {
            return true;
        }

        return false;
    }

    public function calculate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                self::REQ_PARAM_OPERAND_1 => 'required|numeric',
                self::REQ_PARAM_OPERATOR => [
                    'required',
                    Rule::in(array_keys(self::OPERATOR_EMOJIS)),
                ],
                self::REQ_PARAM_OPERAND_2 => 'required|numeric',
            ]);
            $validator->after(function ($validator) use ($request) {
                if (self::isDivisionByZero($request)) {
                    $validator->errors()->add(self::REQ_PARAM_OPERAND_2, 'Division by Zero is forbidden!');
                }
            });

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            switch ($request->{self::REQ_PARAM_OPERATOR}) {
                case self::OPERATOR_ADDITION:
                    $result = $request->{self::REQ_PARAM_OPERAND_1} + $request->{self::REQ_PARAM_OPERAND_2};
                    break;
                case self::OPERATOR_SUBTRACTION:
                    $result = $request->{self::REQ_PARAM_OPERAND_1} - $request->{self::REQ_PARAM_OPERAND_2};
                    break;
                case self::OPERATOR_MULTIPLICATION:
                    $result = $request->{self::REQ_PARAM_OPERAND_1} * $request->{self::REQ_PARAM_OPERAND_2};
                    break;
                case self::OPERATOR_DIVISION:
                    $result = $request->{self::REQ_PARAM_OPERAND_1} / $request->{self::REQ_PARAM_OPERAND_2};
                    break;
                default:
                    $result = null;
            }

            return response()->json([
                'result' => $result,
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error($e->getMessage(), ['request' => $request->all()]);
            return response()->json([
                'message' => 'something went wrong',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
