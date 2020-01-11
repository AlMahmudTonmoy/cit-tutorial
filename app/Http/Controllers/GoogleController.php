<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
use Hash;
use Carbon\Carbon;

class GoogleController extends Controller
{
  /**
   * Redirect the user to the GitHub authentication page.
   *
   * @return \Illuminate\Http\Response
   */
  public function redirectToProvider()
  {
      return Socialite::driver('google')->redirect();
  }

  /**
   * Obtain the user information from GitHub.
   *
   * @return \Illuminate\Http\Response
   */
  public function handleProviderCallback()
  {
      $user = Socialite::driver('google')->user();
      User::insert([
        'name' => $user->getName(),
        'email' => $user->getEmail(),
        'password' => Hash::make('abc1234567'),
        'role' => 2,
        'created_at' => Carbon::now(),
      ]);
      return back()->withSuccess('Account Created Successfully! To login <a href="'. url('login') .'">Click Here</a>');
      // $user->token;
  }
}
