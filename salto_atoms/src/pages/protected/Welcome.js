import { useEffect } from 'react'
import { useDispatch } from 'react-redux'
import { setPageTitle } from '../../features/common/headerSlice'
import {Link} from 'react-router-dom'
import DocGettingStarted from '../../features/documentation/DocGettingStarted'

function InternalPage(){

    const dispatch = useDispatch()

    useEffect(() => {
        dispatch(setPageTitle({ title : ""}))
      }, [])

    return(
      <div className="h-3/5 bg-base-200">
            <DocGettingStarted />
            <Link to="/app/dashboard"><button className="btn bg-base-100 btn-outline mt-4">Get Started</button></Link>
    </div>
    )
}

export default InternalPage