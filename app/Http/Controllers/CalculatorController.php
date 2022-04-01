<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    private const OPERATOR_ADDITION = '+';
    private const OPERATOR_SUBTRACTION = '-';
    private const OPERATOR_MULTIPLICATION = '*';
    private const OPERATOR_DIVISION = '/';

    private const EMOJI_ADDITION = '&#128125;';
    private const EMOJI_SUBTRACTION = '&#128128;';
    private const EMOJI_MULTIPLICATION = '&#128123;';
    private const EMOJI_DIVISION = '&#128561;';

    private const OPERATOR_EMOJIS = [
        self::OPERATOR_ADDITION => self::EMOJI_ADDITION,
        self::OPERATOR_SUBTRACTION => self::EMOJI_SUBTRACTION,
        self::OPERATOR_MULTIPLICATION => self::EMOJI_MULTIPLICATION,
        self::OPERATOR_DIVISION => self::EMOJI_DIVISION,
    ];

    public function index()
    {
        return view('home', [
            'operator_emojis' => self::OPERATOR_EMOJIS,
        ]);
    }
}
