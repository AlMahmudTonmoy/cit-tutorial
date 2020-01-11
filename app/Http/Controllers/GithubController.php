<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
use Hash;
use Str;
use Mail;
use Carbon\Carbon;
use App\Mail\SentPassword;

class GithubController extends Controller
{
  /**
   * Redirect the user to the GitHub authentication page.
   *
   * @return \Illuminate\Http\Response
   */
  public function redirectToProvider()
  {
      return Socialite::driver('github')->redirect();
  }

  /**
   * Obtain the user information from GitHub.
   *
   * @return \Illuminate\Http\Response
   */
  public function handleProviderCallback()
  {
      $generatd_password = Str::random(9);
      $user = Socialite::driver('github')->user();
      User::insert([
        'name' => $user->getNickname(),
        'email' => $user->getEmail(),
        'password' => Hash::make($generatd_password),
        'role' => 2,
        'email_verified_at' => Carbon::now(),
        'created_at' => Carbon::now(),
      ]);
      Mail::to($user->getEmail())->send(new SentPassword($generatd_password));
      return back()->withSuccess('Account Created Successfully! To login <a href="'. url('login') .'">Click Here</a>');
      // $user->token;
  }
}
