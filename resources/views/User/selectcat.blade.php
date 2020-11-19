@extends('template')

@section('content')

<div class="cont">
    <div id="problem-cat-cont">
     

    </div>

</div>

<script type="text/babel">

    class SelectCat extends React.Component{
        constructor(props){
            super(props)
            this.state={
                categories:[
                    { 
                        code:"f",
                        title:"Marriage and family Counselling",
                        description:"Marriage and family therapists offer guidance to couples, families and groups who are dealing with issues that affect their mental health and well-being.",
                        problems:[
                            "Child and adolescent behavioral problems",
                            "Grieving",
                            "Depression and anxiety",
                            "Marital conflicts",
                            "Domestic violence",
                            "Substance abuse"
                        ]
                    },
                    { 
                        code:"m",
                        title:"Mental Health Counseling",
                        description:"Mental health counselors offer guidance to individuals, couples, families and groups who are dealing with issues that affect their mental health and well-being",
                        problems:[
                            "aging",
                            "bullying",
                            "Depression and anxiety",
                            "anger management",
                            "careers",
                            "relationships",
                            "self-image",
                            "stress and suicide",
                            "Substance abuse"
                        ]
                    },
                    { 
                        code:"s",
                        title:"School Psychology Counseling",
                        problems:null,
                        description:"School psychologists assist students at all levels, from elementary school to college. They act along with school counselors as advocates for students’ well-being, and as valuable resources for their educational and personal advancement.",
                        cases:[
                            "Work with school-aged children and young adults",
                            "Listen to concerns about academic, emotional or social problems",
                            "Promote positive behaviors",
                            "Study and implement behavioral management techniques",
                            "Evaluate and advise school disciplinary practices for troubled students",
                            "Meet with parents and teachers to discuss learning, behavioral, familial and social problems"
                        ]
                    },
                ]
            }
            
        }


        render(){

            var categories=this.state.categories.map(category=>{
                if(category.problems!=null){
                    return(
                        <div class="problem-cat-card" key={category.code}>
                            <input type="radio"  name="category" value={category.code} />
                            <h2  className="category-title">{category.title}</h2>
                            <p className="category-description">- {category.description}</p>
                            <p className="category-explanation">The problems you might have ,</p>
                            <ol>
                            {  
                                category.problems.map(prob=>{
                                    return(
                                        <li  key={prob}>{prob}</li>
                                    )
                                })
                            }
                            </ol>
                        </div>
                    )
                }
                else{
                    return(
                        <div class="problem-cat-card" key={category.code}>
                            <input type="radio"  name="category" value={category.code} />
                            <h2 className="category-title">{category.title}</h2>
                            <p className="category-description">- {category.description}</p>
                            <p className="category-explanation">We help with these kind of problems ,</p>
                            <ol >
                            {  
                                category.cases.map(cases=>{
                                    return(      
                                        <li key={cases}>{cases}</li>
                                    )
                                })
                            }
                            </ol>
                        </div>
                    )
                }
            })

            return(
                <div id="problem-cat-card-cont">
                    <h2 class="problem-title">Please select one of these categories</h2>
                    <p class="problem-desc">*So that we will be able to redirect you to a experienced counselour</p>
                    <?php
 
                        if($errors->any()){
                            foreach ($errors->all() as $error) {
                               echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Ohh!</strong> '.$error.'
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div> ';
                            }
                        }
                    ?>

                    <form method="POST" action="{{ route('save-category') }} ">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        {categories}
                        <button class="auth-buttons" type="submit">Next</button>
                    </form>
                </div>
            )
        }



    }

    ReactDOM.render(<SelectCat />,document.getElementById("problem-cat-cont"))
</script>

@endsection