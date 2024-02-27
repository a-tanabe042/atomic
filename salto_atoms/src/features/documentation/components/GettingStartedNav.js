import { useState } from "react"

function GettingStartedNav({activeIndex}){

    const SECTION_NAVS = [
        {name : "Architecture", isActive : activeIndex === 1 ? true : false},
        {name : "How to Use", isActive : false},
    ]
    const [navs, setNavs] = useState(SECTION_NAVS)

    const scrollToSection = (currentIndex) => {
        setNavs(navs.map((n, k) => {
            if(k === currentIndex)return {...n, isActive : true}
            else return {...n, isActive : false}
        }))
        document.getElementById('getstarted'+(currentIndex+1)).scrollIntoView({behavior: 'smooth' })
    }

    return(
        <ul className="menu w-56 mt-10 text-sm">
            <li className="menu-title"><span className="">Getting Started</span></li>
            
            {
                navs.map((n, k) => {
                    return(
                        <li key={k} onClick={() => scrollToSection(k)} className={n.isActive ? "bordered" : ""}><a>{n.name}</a></li>
                    )
                })
            }
        </ul>
    )
}

export default GettingStartedNav