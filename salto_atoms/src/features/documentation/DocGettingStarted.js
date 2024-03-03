import GettingStartedNav from "./components/GettingStartedNav"
import GettingStartedContent from "./components/GettingStartedContent"
import useLoading from '../../hooks/useLoading';
import Loading from "../../components/loading/Loading";


function GettingStarted(){
    const delay = parseInt(process.env.REACT_APP_LOADING_DELAY, 10) || 2000; 
    const isLoading = useLoading(delay);
    if (isLoading) {
        return <Loading />;
      }
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