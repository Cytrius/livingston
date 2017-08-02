<?php

namespace App\Http\Controllers;

use App\Quotes as QuotesModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuotesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * @param $quote_id
     * @param $returning
     * @return null
     */
    public function notifyQuote($quote_id, $returning = true)
    {

        $quote = QuotesModel::with('account')->with('user')->where('id', $quote_id)->first();

        if (!$quote)
        {
            return response()->json(['error' => 'Quote not found'], 404);
        }

        // Send to customer, no rates included
        \Mail::send('emails.quote', ['quote' => $quote, 'admin' => false], function ($message) use ($quote)
        {
            $message->to($quote->user->email);
            $message->subject('Livingston Vehicle Transportation | QUOTE #' . $quote->id);
        });

        if ($returning)
        {
            return response()->json($emails);
        }
        else
        {
            return;
        }

    }

    /**
     * @param $quote_id
     * @param $returning
     * @return null
     */
    public function notifyBooking($quote_id, $returning = true)
    {

        $quote = QuotesModel::with('account')->with('user')->where('id', $quote_id)->first();

        if (!$quote)
        {
            return response()->json(['error' => 'Quote not found'], 404);
        }

        // Send to staff - with rates

        $emails = ['kev.langlois@gmail.com'];

        \Mail::send('emails.quote', ['quote' => $quote, 'admin' => true], function ($message) use ($emails, $quote)
        {
            // Default box
            $message->to('kev.langlois+livingston@gmail.com');

            // All other notifiers
            foreach ($emails as $email)
            {
                $message->cc($email);
            }

            $message->subject('Livingston Vehicle Transportation | QUOTE #' . $quote->id);
        });

        if ($returning)
        {
            return response()->json($emails);
        }
        else
        {
            return;
        }

    }

    /**
     * @param Request $request
     */
    public function getAllQuotes(Request $request)
    {

        $quotes = QuotesModel::with('account')->with('user')->orderBy('created_at', 'DESC');

        $quotes->limit(10);

        if ($request->has('page'))
        {
            $quotes->offset($request->get('page') * 10);
        }

        $quotes = $quotes->orderBy('created_at', 'ASC')->get();

        return response()->json($quotes);
    }

    /**
     * @param Request $request
     */
    public function getFilteredQuotes(Request $request)
    {

        $quotes = QuotesModel::select('*');

        if ($request->has('origin'))
        {
            $quotes->where('origin', $request->get('origin'));
        }

        if ($request->has('destination'))
        {
            $quotes->where('destination', $request->get('destination'));
        }

        if ($request->has('account'))
        {
            $quotes->where('account_id', $request->get('account'));
        }

        if ($request->has('created_at'))
        {
            $date = new Carbon($request->get('created_at'));
            $day_start = $date->copy()->startOfDay();
            $day_end = $date->copy()->endOfDay();
            $quotes->where('created_at', '>=', $day_start)->where('created_at', '<=', $day_end);
        }

        $quotes->limit(10);

        if ($request->has('page'))
        {
            $quotes->offset($request->get('page') * 10);
        }

        $quotes = $quotes->with('account')->with('user')->get();

        return response()->json($quotes);
    }

    public function getAllQuotesFilters()
    {

        $accounts = QuotesModel::select('account_id')->groupBy('account_id')->with('account')->get();

        $origins = QuotesModel::select('origin')->groupBy('origin')->get();

        $destinations = QuotesModel::select('destination')->groupBy('destination')->get();

        $results = [
            'origins' => $origins,
            'destinations' => $destinations,
            'accounts' => $accounts,
        ];

        return response()->json($results);

    }

    /**
     * @param Request $request
     * @param $quote_id
     */
    public function getQuoteById(Request $request, $quote_id)
    {

        $quote = QuotesModel::with('account')->with('user')->where('id', $quote_id)->first();

        return response()->json($quote);
    }

}
