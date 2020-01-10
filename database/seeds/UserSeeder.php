<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'fname' => 'Leo',
            'lname' => 'Felipa',
            'email' => 'leo@lfelipa.com',
            'phone' => '6476889189',
            'bio' => '<p>I love design. I love coding. I love the web. I want to help you bring your vision to the web. I have an eye for clean design and UX.</p>

            <p>I&#39;ve spent the last years immersed in learning Frontend &amp; Backend Web Development, both through codeschool.com and a certification program locally.</p>
            
            <p>If I&#39;m not coding I&#39;m either tinkering with my Arduino, working out at my local gym, or painting portraits.</p>',
            'skills_and_offer' => '<p>I am a full-stack web developer with over three years of experience.</p>

            <p>I have maintained, developed and launched multiple projects from scratch, carrying the development of its&#39; back-end and front-end codebases.</p>
            
            <p>My current toolset includes Vue.js &amp; Laravel Framework, Node.JS, React, Angular, TypeScript, and all the other various frameworks, libraries and technologies related to them.</p>
            
            <p>Feel free to ask me any questions. I can help you in your project in all from the UI mockups, back-end and front-end web development to fixing the design and installing &amp; configuration of the application on staging/production environments.</p>
            
            <p><em>Call me a Swiss Army Knife in terms of web development.</em></p>
            
            <p>&nbsp;</p>
            
            <h2>Front-end Web Development</h2>
            
            <p>I specialize in applications written in Laravel and Vue.js. Recently I became also a huge fan of one-way data flow and Redux-like architecture and also typed languages, e.g. TypeScript.</p>
            
            <p>My current experience and skills in front-end include:</p>
            
            <ul>
                <li>lead JavaScript development: bootstraping or refactoring an existing app architecture, by improving its&#39; extensibility and reliability;</li>
                <li>full integration of front-end development using tools like&nbsp;<a href="https://webpack.js.org/">Webpack</a>&nbsp;with features like automatic code reload, code minifications, multiple environments support,</li>
                <li>good sense of design and UX, by having some past experience in graphic design</li>
                <li>knowledge and huge experience in many JS ecosystem, by using many libraries like Vue.js, RxJS, Angular, Ionic Framework, jQuery, Lodash/Underscore and whatever else needed.</li>
            </ul>
            
            <h3>Back-end Web Development</h3>
            
            <p>In back-end development, my current stack involves Elixir and Laravel Framework, and alternatively Ruby on Rails or NodeJS.</p>
            
            <p>Nearly every app I have done in the past had the back-end written also by me. In order to improve the development speed, performance and reliability, I have changed languages and frameworks already multiple times, from Javascript to PHP.</p>
            
            <p>Luckily, my experience and lessons I learned while doing all those apps, will stay with me and be useful forever, no matter what framework I will use in the next project.</p>
            
            <p>What I can do is:</p>
            
            <ul>
                <li>lead development of web apps in PHP/Javascript</li>
                <li>cooperation with APIs, remote data synchronizations, cloud servers, asynchronous workers</li>
                <li>using different types of databases</li>
                <li>refactoring existing applications, by improving code readibility, separating concerns into separate functions and classes, splitting out the business logic from app&#39;s views and controllers (<a href="https://en.wikipedia.org/wiki/Domain-driven_design">DDD</a>), and moving the app architecture into more event-based one</li>
                <li>writing unit and e2e tests</li>
            </ul>
            
            <p>Thus, not only I have coded their back-end and front-end code, but often I also had to care about other things needed in a successful web application:</p>
            
            <p>&nbsp;</p>',
            'email_verified_at'  => Carbon::now(),
            'password' =>  Hash::make('password'),
     
        ]);
    }
}
