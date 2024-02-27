import GettingStartedNav from "./components/GettingStartedNav"
import GettingStartedContent from "./components/GettingStartedContent"

function GettingStarted(){
    return(
        <>
            <div className="bg-base-100  flex overflow-hidden  rounded-lg" style={{height : "82vh"}}>
                    <div className="flex-none p-4">
                        <GettingStartedNav activeIndex={1}/>
                    </div>
                    <div className="grow pt-16  overflow-y-scroll">
                        <GettingStartedContent />
                    </div>

                </div>
           
        </>
    )
}

export default GettingStarted