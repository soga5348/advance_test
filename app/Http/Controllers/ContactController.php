<?php
namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
{

    $postal_code = $request->input('postal_code');
    $postal_code = mb_convert_kana($postal_code, 'a');
    $request->merge(['postal_code' => $postal_code]);

    $request->validate([
        'firstname' => 'required',
        'lastname' => 'required',
        'gender' => 'required|array',
        'gender.*' => 'in:male,female',
        'email' => 'required|email',
        'postal_code' => 'required|regex:/^[0-9]{3}-[0-9]{4}$/','max:8',
        'address' => 'required',
        'message' => 'required|max:120',
    ], [
        'firstname.required' => '苗字は必須項目です。',
        'lastname.required' => '名前は必須項目です。',
        'gender.required' => '性別は必須項目です。',
        'gender.array' => '性別は必須項目です。',
        'gender.*.in' => '性別は男性か女性を選択してください。',
        'email.required' => 'メールアドレスは必須項目です。',
        'email.email' => '正しいメールアドレスを入力してください。',
        'postal_code.required' => '郵便番号は必須項目です。',
        'postal_code.regex' => '郵便番号は「000-0000」の形式で入力してください。',
        'address.required' => '住所は必須項目です。',
        'message.required' => 'ご意見は必須項目です。',
        'message.max' => 'ご意見は120文字以内で入力してください。',
    ]);
    

    $contact = new Contact;
    $contact->firstname = $request->input('firstname');
    $contact->lastname = $request->input('lastname');
    $contact->gender = implode(',', $request->input('gender'));
    $contact->email = $request->input('email');
    $contact->postal_code = $request->input('postal_code');
    $contact->address = $request->input('address');
    $contact->building = $request->input('building');
    $contact->message = $request->input('message');
    $contact->save();
    return view('confirm', ['contact' => $contact]);
}

public function confirm(Contact $contact)
{
    // 確認ページで保存したデータを表示する
    return view('confirm', compact('contact'));
}

public function thanks(Contact $contact)
{
    // 確認ページで保存したデータを表示する
    return view('thanks');
}

public function back(Contact $contact)
{
    // セッションにフォームの入力内容を保存
    session()->flashInput(request()->except('_token'));

    // index ページにリダイレクト
    return redirect()->route('index');
}

public function find(Request $request)
{
    $query = Contact::query();

    // 性別で絞り込み
    if (!empty($request->input('gender'))) {
        $genders = $request->input('gender');
        if ($genders == 'all') {
            $query->whereIn('gender', ['Male', 'Female']);
            
        } elseif ($genders == 'Female') {
            $query->where('gender', 'Female');
        } else {
            $query->where('gender', 'Male');
        }
    }

    // その他の絞り込み条件

    $messages = $query->orderBy('created_at', 'desc')->paginate(10);

    // 性別で絞り込みがされている場合は、その性別に該当するページのみを取得するようにする
    if (!empty($request->input('gender'))) {
        $messages->appends(['gender' => $request->input('gender')]);
    }

    return view('find', ['messages' => $messages]);
}



public function message(Request $request)


{
    $query = Contact::query();

    $search = $request->input('name');
$start_date = $request->input('start_date');
$end_date = $request->input('end_date');
$email = $request->input('email');


    // 名前で絞り込み
    if (!empty($request->input('name'))) {
        $search = $request->input('name');
        $query->where(function($query) use ($search) {
            $query->where('firstname', 'like', '%' . $search . '%')
                  ->orWhere('lastname', 'like', '%' . $search . '%')
                  ->orWhereRaw("CONCAT(firstname, lastname) LIKE ?", ['%' . $search . '%']);
        });
    }
    

    // 性別で絞り込み
    // 性別で絞り込み
    if (!empty($request->input('gender'))) {
        $genders = $request->input('gender');
        if ($genders == 'all') {
            $query->whereIn('gender', ['Male', 'Female']);
            
        } elseif ($genders == 'Female') {
            $query->where('gender', 'Female');
        }
        
        else {
            $query->where('gender', 'Male');
        }
    }
   


// 登録日で絞り込み
$start_date = $request->input('start_date');
$end_date = $request->input('end_date');
if (!empty($start_date) && !empty($end_date)) {
    $end_date = Carbon::parse($end_date)->addDay()->toDateString();
    $query->whereBetween('created_at', [$start_date, $end_date]);
}
    

    


    // メールアドレスで絞り込み
    if (!empty($request->input('email'))) {
        $query->where('email', 'like', '%' . $request->input('email') . '%');
    }

    $messages = $query->paginate(10); 
    $messages = $query->paginate(10);
    $messages->appends([
        'gender' => $request->input('gender'),
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'start_date' => $request->input('start_date'),
        'end_date' => $request->input('end_date')
    ]);
    

    return view('find', compact('messages'));

}

public function destroy(Contact $contact)
{
    $contact->delete();
    return redirect()->route('find')->with('success', 'データを削除しました。');
}

public function address($postalCode)
    {
        $response = Http::get("https://zipcloud.ibsnet.co.jp/api/search?zipcode={$postalCode}");
        $result = $response->json();
        if ($result['status'] == 200) {
            return response()->json(['address' => $result['results'][0]['address1'].$result['results'][0]['address2'].$result['results'][0]['address3']]);
        } else {
            return response()->json(['address' => '']);
        }
    }



}