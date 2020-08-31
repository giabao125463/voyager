@extends('layouts.front')

@section('page_title', 'ショッピングカート')

@section('head')
@endsection

@section('javascript')
@endsection

@section('content')
        <!-- start page title section -->
        <section class="wow fadeIn bg-extra-dark-gray padding-35px-tb page-title-small top-space">
            <div class="container">
                <div class="row equalize">
                    <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 display-table">
                        <div class="display-table-cell vertical-align-middle text-left xs-text-center">
                            <!-- start page title -->
                            <h1 class="alt-font text-white font-weight-600 no-margin-bottom text-uppercase">Contact Form</h1>
                            <!-- end page title -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 display-table text-right xs-text-left xs-margin-10px-top">
                        <div class="display-table-cell vertical-align-middle breadcrumb text-small alt-font">
                            <!-- start breadcrumb -->
                            <ul class="xs-text-center">
                                <li><a href="#" class="text-dark-gray">Elements</a></li>
                                <li><a href="#" class="text-dark-gray">General elements</a></li>
                                <li class="text-dark-gray">Contact form</li>
                            </ul>
                            <!-- end breadcrumb -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end page title section -->
        <!-- start form style 01 section -->
        <section class="wow fadeIn" id="start-your-project">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-sm-12 col-xs-12 center-col text-center margin-100px-bottom xs-margin-40px-bottom">
                        <div class="position-relative overflow-hidden width-100">
                            <span class="text-small text-outside-line-full alt-font font-weight-600 text-uppercase">Contact Form Style 01</span>
                        </div>
                    </div>
                </div>
                <form id="project-contact-form" action="javascript:void(0)" method="post">
                    <div class="row">
                         <div class="col-md-12">
                             <div id="success-project-contact-form" class="no-margin-lr"></div>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="name" id="name" placeholder="Name *" class="big-input">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="phone" id="phone" placeholder="Phone"  class="big-input">
                        </div>
                        <div class="col-md-6">
                             <input type="text" name="email" id="email" placeholder="E-mail *" class="big-input">
                        </div>
                        <div class="col-md-6">
                            <div class="select-style big-select">
                                <select name="budget" id="budget" class="bg-transparent no-margin-bottom">
                                    <option value="">Select your budget</option>
                                    <option value="$500 - $1000">$500 - $1000</option>
                                    <option value="$1000 - $2000">$1000 - $2000</option>
                                    <option value="$2000 - $5000">$2000 - $5000</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <textarea name="comment" id="comment" placeholder="Describe your project" rows="6" class="big-textarea"></textarea>
                        </div>
                        <div class="col-md-12 text-center">
                            <button id="project-contact-us-button" type="submit" class="btn btn-transparent-dark-gray btn-large margin-20px-top">send message</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- end form style 01 section -->
        <!-- start form style 02 section -->
        <section class="wow fadeIn bg-extra-dark-gray">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-sm-12 col-xs-12 center-col text-center margin-100px-bottom xs-margin-40px-bottom">
                        <div class="position-relative overflow-hidden width-100">
                            <span class="text-small text-outside-line-full alt-font font-weight-600 text-uppercase">Contact Form Style 02</span>
                        </div>
                    </div>
                </div>
                <form id="contact-form-2" action="javascript:void(0)" method="post">
                    <div class="row">
                        <div class="col-md-8 wow fadeIn center-col text-center">
                            <div id="success-contact-form-2" class="no-margin-lr"></div>
                            <input type="text" name="name" id="name" placeholder="Name*" class="input-border-bottom">
                            <input type="text" name="email" id="email" placeholder="E-mail*" class="input-border-bottom">
                            <input type="text" id="subject" name="subject" placeholder="Subject" class="input-border-bottom">
                            <textarea name="comment" id="comment"  placeholder="Your Message" class="input-border-bottom"></textarea>
                            <button id="contact-us-button-2" type="submit" class="btn btn-small btn-deep-pink margin-30px-top xs-margin-three-top">send message</button>
                        </div>
                    </div>
                </form>
            </div>     
        </section>
        <!-- end form style 02 section -->
        <!-- start form style 03 section -->
        <section class="wow fadeIn bg-light-gray">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-sm-12 col-xs-12 center-col text-center margin-100px-bottom xs-margin-40px-bottom">
                        <div class="position-relative overflow-hidden width-100">
                            <span class="text-small text-outside-line-full alt-font font-weight-600 text-uppercase">Contact Form Style 03</span>
                        </div>
                    </div>
                </div>
                <form id="contact-form-3" action="javascript:void(0)" method="post">
                    <div class="row"> 
                        <div class="col-md-6 wow fadeIn center-col">
                            <div class="padding-fifteen-all bg-white border-radius-6 md-padding-seven-all">
                                <div class="text-extra-dark-gray alt-font text-large font-weight-600 margin-30px-bottom">Looking for a excellent business idea?</div> 
                                <div>
                                     <div id="success-contact-form-3" class="no-margin-lr"></div>
                                    <input type="text" name="name" id="name" placeholder="Name*" class="input-bg">
                                    <input type="text" name="email" id="email" placeholder="E-mail*" class="input-bg">
                                    <input type="text" name="subject" id="subject" placeholder="Subject" class="input-bg">
                                    <textarea name="comment" id="comment" placeholder="Your Message" class="input-bg"></textarea>
                                    <button id="contact-us-button-3" type="submit" class="btn btn-small border-radius-4 btn-black">send message</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>     
        </section>
        <!-- end form style 02 section -->
        <!-- start form style 04 section -->
        <section class="wow fadeIn parallax" data-stellar-background-ratio="0.5" style="background-image:url('http://placehold.it/1920x1080');">
            <div class="opacity-full bg-black"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-sm-12 col-xs-12 center-col text-center margin-100px-bottom xs-margin-40px-bottom">
                        <div class="position-relative overflow-hidden width-100">
                            <span class="text-small text-outside-line-full alt-font font-weight-600 text-uppercase">Contact Form Style 04</span>
                        </div>
                    </div>
                </div>
                <form id="project-contact-form-4" action="javascript:void(0)" method="post">
                    <div class="row">
                        <div class="col-md-12 sm-clear-both">
                            <div id="success-project-contact-form-4" class="no-margin-lr"></div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <input type="text" name="name" id="name" placeholder="Name *" class="bg-transparent border-color-medium-dark-gray medium-input">
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <input type="text" name="phone" id="phone" placeholder="Phone" class="bg-transparent border-color-medium-dark-gray medium-input">
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <input type="text" name="email" id="email" placeholder="E-mail *" class="bg-transparent border-color-medium-dark-gray medium-input">
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="select-style medium-select border-color-medium-dark-gray">
                                <select name="budget" id="budget" class="bg-transparent no-margin-bottom">
                                    <option value="">Select your budget</option>
                                    <option value="$500 - $1000">$500 - $1000</option>
                                    <option value="$1000 - $2000">$1000 - $2000</option>
                                    <option value="$2000 - $5000">$2000 - $5000</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 sm-clear-both">
                            <textarea name="comment" id="comment" placeholder="Describe your project" rows="6" class="bg-transparent border-color-medium-dark-gray medium-textarea"></textarea>
                        </div>
                        <div class="col-md-12 text-center">
                            <button id="project-contact-us-4-button" type="submit" class="btn btn-deep-pink btn-rounded btn-medium margin-20px-top xs-no-margin-top">send message</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- end form style 04 section -->
@endsection