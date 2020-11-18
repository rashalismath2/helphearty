<div class="containers-layout" >
    <h1 class="main-cont-header">
        Our service,
    </h1>

    <div class="cont-left">
        <img class="mt-4 service-img" src="./img/service.png" alt="" srcset="">
    </div>

    <div class="cont-right service-cont-right">
        <p class="mt-4 service-desc">
            <span class="ml-10">
              Our platform is built anyone to find a consultant easily and interact
              with them 24*7 using text or video conversations.
              <br />
              <br />
              <span class="font-weight-bold">
                We are bound to protect your anonymissy and the conversations on the
                internet. All you have to do is signup and answer to some simple
                questions and you can get started with a consultant you like whose
                specialized and prepared to help with the problem you have.
              </span>
            </span>
        </p>

        <p class="service-help-title">How do i get started?</p>

        <div id="service-help-getstarted">

            <div class="service-help-card shadow clearfix">
                <div class="service-help-contents">
                    <p>Register</p>
                    <p>Use your email to create an account</p>
                    @if (!auth()->check())
                        <a class="auth-buttons"><i class="fas fa-user-plus fa-md"></i> Register</a>
                    @endif
                </div>
                <div class="service-help-number"><p>1</p></div>
            </div>

            <div class="service-help-card shadow clearfix">
                <div class="service-help-contents">
                    <p>Let us understand your problem</p>
                    <p>
                        You will be asked to answer some questions when you register for the first time. These questions
                        will describe your problem so that we can direct you to a consultant
                        whos specialized in that area
                    </p>
                </div>
                <div class="service-help-number"><p>2</p></div>
            </div>

            <div class="service-help-card shadow clearfix">
                <div class="service-help-contents">
                    <p>Get started</p>
                    <p>
                        You can start start conversation by requesting to a consultant in our platform.
                    </p>
                </div>
                <div class="service-help-number"><p>2</p></div>
            </div>

        </div>


    </div>

</div>    