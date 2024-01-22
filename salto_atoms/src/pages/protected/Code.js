import { useEffect } from 'react';
import { useDispatch } from 'react-redux';
import { setPageTitle } from '../../features/common/headerSlice';
import Coding from '../../features/code/index';

function InternalPage() {
    const dispatch = useDispatch();

    useEffect(() => {
        dispatch(setPageTitle({ title: "Salto Code" }));
    }, [dispatch]);

    return <Coding />;
}

export default InternalPage;
