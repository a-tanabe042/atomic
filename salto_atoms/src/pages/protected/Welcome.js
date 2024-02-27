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
    </div>
    )
}

export default InternalPage