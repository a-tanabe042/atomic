import { useEffect } from 'react'
import { useDispatch } from 'react-redux'
import { setPageTitle } from '../../features/common/headerSlice'
import OrganizationChart from '../../features/settings/organization-chart'

function InternalPage(){
    const dispatch = useDispatch()

    useEffect(() => {
        dispatch(setPageTitle({ title : "組織図"}))
      }, [])


    return(
        <OrganizationChart />
    )
}

export default InternalPage