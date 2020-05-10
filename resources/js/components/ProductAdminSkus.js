import React, { useState } from 'react';
import cloneDeep from "lodash/cloneDeep";
import find from 'lodash/find'

export default function ProductAdminSkus(props) {

    let { selectedParams, data } = props;
    let [value, setValue] = useState(data);

    let findByParams = (params) => {
        let item = find(value, item => {
            let found = true;

            for (let p of params) {
                found &= find(item.attrs, p => p.attribute_item_id === p.id);
            }

            return found;
        })
    }

    let rows = [];

    let collectKeys = (item = { params: [] }, handledGroupsForIteration = []) => {

        for (let a of selectedParams) {
            if (handledGroupsForIteration.indexOf(a.slug) !== -1) continue;
            handledGroupsForIteration.push(a.slug);

            for (let attr of a.items) {
                let localItem = cloneDeep(item);

                localItem.params.push({
                    'id': attr.id,
                    'name': attr.name,
                    'slug': attr.slug,
                })

                collectKeys(cloneDeep(localItem), cloneDeep(handledGroupsForIteration));

                if (localItem.params.length === selectedParams.length) {
                    let tds = [];

                    for (let p of localItem.params) {
                        tds.push(<td key={p.slug}>{p.slug} - {p.name}</td>)
                    }

                    let changeSku = field => value => {
                        let sku = findByParams(localItem.params);
                    };

                    tds.push(
                        <td key="cnt">
                            <input onChange={e => changeSku('qty')(e.target.value)} className="form-control"
                                   placeholder='количество' />
                        </td>
                    )
                    let key = localItem.params.map(i => i.slug).join(':')
                    rows.push(<tr key={key}>{tds}</tr>);
                }
            }
        }
    }

    collectKeys();

    return <div>
        <input type="" name={'attributes'} readOnly={true} value={JSON.stringify(value)} />

        <table className="table">
            <tbody>
            {rows}
            </tbody>
        </table>

    </div>
}
