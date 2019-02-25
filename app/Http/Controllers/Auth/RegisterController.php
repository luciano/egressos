<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Student;
use App\Address;
use App\Phone;
use App\StudentCourse;
use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/users/list';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        if ($request->hasFile('lista-usuarios')) {
            $file = file_get_contents($request->file('lista-usuarios'));

            $file = utf8_encode($file); 
            $jsonFile = json_decode($file, true);

            $i = 0;
            foreach ($jsonFile as $dataArray) 
            {
                ++$i;
                if ($i == 10) break;

                // insert user
                $userInfo = array(
                    '_token' => Str::random(32),
                    'name' => $dataArray['nome'],
                    'email' => $dataArray['email'],
                    'cpf_number' => $dataArray['cpf'],
                    'password' => $dataArray['cpf'],
                    'password_confirmation' => $dataArray['cpf']
                );

                $dataArray['celular'] = preg_replace('/\-/', '', $dataArray['celular']);
                $dataArray['celular'] = preg_replace('/\(/', '', $dataArray['celular']);
                $dataArray['celular'] = preg_replace('/\)/', '', $dataArray['celular']);
                $dataArray['celular'] = preg_replace('/\s/', '', $dataArray['celular']);
                $dataArray['telefone'] = preg_replace('/\-/', '', $dataArray['telefone']);
                $dataArray['telefone'] = preg_replace('/\(/', '', $dataArray['telefone']);
                $dataArray['telefone'] = preg_replace('/\)/', '', $dataArray['telefone']);
                $dataArray['telefone'] = preg_replace('/\s/', '', $dataArray['telefone']);

                
                $dataArray['curso'] = mb_convert_case($dataArray['curso'], MB_CASE_TITLE, "UTF-8");
                $dataArray['endereco'] = mb_convert_case($dataArray['endereco'], MB_CASE_TITLE, "UTF-8");
                $dataArray['bairro'] = mb_convert_case($dataArray['bairro'], MB_CASE_TITLE, "UTF-8");
                $dataArray['municipio'] = mb_convert_case($dataArray['municipio'], MB_CASE_TITLE, "UTF-8");

                if ( preg_match_all('/graduação/', mb_strtolower($dataArray['tipo'], 'UTF-8')) ) {
                    $dataArray['tipo'] = "Graduação"; 
                } else {
                    $dataArray['tipo'] = "Especialização"; 
                }

                // verificar
                //$this->validator($userInfo)->validate();
                $user = $this->create($userInfo);
                event(new Registered($user));

                // insert student
                $student = Student::create([
                    'register' => trim($dataArray['matricula']),
                    'bithday' => $dataArray['datanasc'],
                    'gender' => $dataArray['sexo'],
                    'user_id' => $user->id,
                ]);

                // insert address
                $address = Address::create([
                    'street' => $dataArray['endereco'],
                    'neighbor' => $dataArray['bairro'],
                    'city' => $dataArray['municipio'],
                    'state' => $dataArray['iduf'],
                    'cep' => $dataArray['cep'],
                    'student_id' => $student->id,
                ]);

                // insert phone
                if (!empty($dataArray['telefone']))
                $phone1 = Phone::create([
                    'number' => $dataArray['telefone'],
                    'student_id' => $student->id,
                ]);

                if (!empty($dataArray['celular']))
                $phone2 = Phone::create([
                    'number' => $dataArray['celular'],
                    'student_id' => $student->id,
                ]);

                //  insert course
                $course = Course::firstOrCreate([
                    'name' => $dataArray['curso'],
                    'typ' => $dataArray['tipo'],
                ]);

                // insert student course
                $studentCourse = StudentCourse::create([
                    'conclusion_date' => $dataArray['dataconclusao'],
                    'student_id' => $student->id,
                    'course_id' => $course->id,
                ]);
            }

            /*
            foreach ($file as $key => $value) {
                // create here the fields to fill the DB
                // nome	
                // matricula
                // cpf
                // email
                // curso
                // tipo
                // dataconclusao
                // datanasc
                // sexo
                // endereco
                // bairro
                // iduf
                // cep
                // telefone
                // celular
                // municipio
                // cursograd
                // anoconclusaograd
                // anoconclusaopos

                $nome; // user
                $matricula; // student 
                $cpf; // user
                $email; // user
                $curso; // course
                $tipo; // course
                $dataconclusao; // student_course
                $datanasc; // student
                $sexo; // student
                $endereco; // address
                $bairro; // address
                $uf; // address
                $cep; // address
                $telefone; // phone
                $celular; // phone
                $municipio; // address
                $cursograd; // discart
                $anoconclusaograd; // discart
                $anoconclusaopos; // discart

                 echo $value.'<br><br>';

                $teste = preg_split('/\"\,/', $value);

                //dd($teste);
                echo '<pre>';
                print_r( str_replace('"', '', $teste) );
                echo '</pre>';
                echo '<br><br>';
            }
            */
            return "yes it has a file";
        } else {
            return "no";
        }

        //$this->validator($request->all())->validate();

        //event(new Registered($user = $this->create($request->all())));

        //$this->guard('user')->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'cpf_number' => 'required|string|max:11',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'cpf_number' => $data['cpf_number'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
