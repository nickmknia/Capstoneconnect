<?php 
 
class AuthController extends BaseController 
{

    /**
     * Display the login page
     * @return View
     */
    public function getLogin()
    {
        return View::make('login');
    }

    /**
     * Login action
     * @return Redirect
     */
    public function postLogin()
    {
            //Get input from user
            $credentials = array(
                    'email' => Input::get('email'),
                    'password' => Input::get('password')
            );
            
            // Set Validation Rules
            $rules = array (
                    'email' => 'required|min:4|max:32|email|Exists:users,email|Regex:/.sc.edu$/',
                    'password' => 'required|min:5'
                    );

            //Run input validation
            $validator = Validator::make($credentials, $rules);

            //Check $credentials against $rules
            if ($validator->fails())
            {
                return Redirect::to('login')->withErrors($validator)->withInput();
            }

            try
            {
                $rememberMe = Input::get('remember');
                $user = Sentry::authenticate($credentials, $rememberMe);

                //if admin logs in
                if (  Sentry::getUser()->hasAnyAccess(array('admin')) )
                {   //go to admin page
                    return Redirect::to('admin_users');
                }

                if ($user)
                {
                    //go home
                    return Redirect::to('home');
                }
            }
            /*catch(\Exception $e)
            {
                    echo "{$credentials['email']}";
                    echo " {$credentials['password']}";
                    echo "{ $user}";//return Redirect::to('/mygrades')->withErrors(array('login' => $e->getMessage()));
            }*/
            catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
            {
                Session::flash('loginError', 'Invalid username or password.' );
                return Redirect::to('login')->withErrors($validator)->withInput();
            }
            catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
            {
                Session::flash('loginError', 'Login field is required.' );
                return Redirect::to('login')->withErrors($validator)->withInput();
            }
            catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
            {
                Session::flash('loginError', 'Password field is required.' );
                return Redirect::to('login')->withErrors($validator)->withInput();
            }

    }

    /**
     * Logout action
     * @return Redirect
     */
    public function getLogout()
    {
            Sentry::logout();
            Session::flash('logoutSuccess', 'You have successfully logged out' );
            return Redirect::to('login'); 
    }

    /**
     *Register User
     *@return view
     */
    public function showRegister()
    {
        return View::make('register');
    }

    /**
     *Activate newly registered user or reply
     *that the user isn't in the class.
     *@return view
     */
    public function activateUser() 
    {
        $user = User::where('email','=',$_POST["email"])->where('activated','=',false)->first();

        if(is_null($user))
        {
            Session::flash('registerError', 'Either your account is already active or your email is not in the capstone email list.' );
            return Redirect::to('register');
        }
        else
        {
            $user->password = Hash::make($_POST["password"]);
            $user->activated = true;
            $user->save();

            Session::flash('registerSuccess', 'You have successfully registered' );
            return Redirect::to('login');
        }
    }
}
 
